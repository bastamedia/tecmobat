{
  pkgs,
  lib,
  config,
  ...
}: let
  app = "wpdemo";
  socket = "/run/phpfpm/${app}.sock";
  domain = "localhost";
in {
  containers.wp = {
    config = {
      networking.firewall.enable = false;
      security.acme.defaults.email = "admin@docker.localdev";
      networking.firewall.allowedTCPPorts = [80 82];
      services.traefik = {
        enable = true;
        staticConfigOptions = {
          providers.docker = {
            exposedByDefault = false;
          };
          entryPoints.web.address = ":80";
        };
        dynamicConfigOptions = {
          http.routers.wp = {
            rule = "Host(`wp.docker.localdev`)";
            entryPoints = ["web"];
            service = "wp-service";
          };
          http.services.wp-service.loadBalancer.server.port = 80;
        };
      };

      services.phpfpm.pools.${app} = {
        user = app;
        settings = {
          "listen.owner" = "nginx";
          "pm" = "dynamic";
          "pm.max_children" = 32;
          "pm.max_requests" = 500;
          "pm.start_servers" = 2;
          "pm.min_spare_servers" = 2;
          "pm.max_spare_servers" = 5;
          "php_admin_value[error_log]" = "stderr";
          "php_admin_flag[log_errors]" = true;
          "catch_workers_output" = true;
        };
        phpEnv."PATH" = lib.makeBinPath [pkgs.php];
      };

      services.mysql = {
        enable = true;
        package = pkgs.mariadb;
        settings = {
          "mysqld" = {
            "port" = 3308;
          };
        };
        initialScript = pkgs.writeText "initial-script" ''
          CREATE DATABASE IF NOT EXISTS wordpress;
          CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'password';
          GRANT ALL PRIVILEGES ON wordpress.* TO 'admin'@'localhost';
        '';

        ensureDatabases = [
          "wordpress"
        ];
        ensureUsers = [
          {
            name = "admin";
            ensurePermissions = {
              "admin.*" = "ALL PRIVILEGES";
              "*.*" = "ALL PRIVILEGES";
            };
          }
        ];
      };

      systemd.services.wordpress.serviceConfig = {
        ProtectSystem = lib.mkForce false;
        ProtectHome = lib.mkForce false;
        ReadWritePaths = ["/var" "/home" "/home/www"];
      };

      systemd.services.wpsetup = {
        path = with pkgs; [coreutils wget gzip curl unzip rsync];
        wantedBy = ["multi-user.target"];
        script = ''

          mkdir -p /var/www/wpdemo

          # WordPress
          cd  /var/www/wpdemo
          curl -L https://wordpress.org/latest.zip -o wordpress.zip
          unzip wordpress.zip -d ./tmp
          mv ./tmp/*/* .
          rm -rf tmp
          rm ./wordpress.zip

          #  Storefront theme
          cd  /var/www/wpdemo/wp-content/themes
          curl -L https://downloads.wordpress.org/theme/storefront.4.2.0.zip -o storefront.zip
          unzip storefront.zip
          rm storefront.zip

          #  WooCommerce plugin
          cd  /var/www/wpdemo/wp-content/plugins
          curl -L https://downloads.wordpress.org/plugin/woocommerce.7.4.1.zip -o woocommerce.zip
          unzip woocommerce.zip
          rm woocommerce.zip
          chmod 777 -R  /var/www/wpdemo
        '';
        serviceConfig = {
          ProtectSystem = lib.mkForce false;
          ProtectHome = lib.mkForce false;
          ReadWritePaths = ["/var" "/home" "/home/wpdemo" "/home/wpdemo/www"];
        };
      };

      systemd.services.ngnix.serviceConfig = {
        ProtectSystem = lib.mkForce false;
        ProtectHome = lib.mkForce false;
        ReadWritePaths = ["/var" "/home" "/home/wpdemo" "/home/wpdemo/www"];
      };
      services.nginx = {
        enable = true;

        virtualHosts.${domain} = {
          listen = [
            {
              addr = "127.0.0.1";
              port = 80;
            }
          ];
          serverName = "wp.docker.localdev";

          locations."/" = {
            root = "/var/www/wpdemo";
            extraConfig = ''
              access_log off;
              charset utf-8;
              etag off;
              index index.php;

              location ~ \.php$ {
                  fastcgi_split_path_info ^(.+\.php)(/.+)$;
                  fastcgi_pass  unix:${socket};
                  include ${pkgs.nginx}/conf/fastcgi_params;
                  include ${pkgs.nginx}/conf/fastcgi.conf;
              }
            '';
          };
        };
      };

      users.mutableUsers = true;

      users.users.${app} = {
        isSystemUser = true;
        createHome = true;
        home = "/home/wpdemo";
        group = app;
      };
      users.groups.${app} = {};
    };
    # bindMounts = {
    #   "/var/www/wpdemo/wp-content/themes" = {
    #     hostPath = "/var/www/wpdemo/wp-content/themes/";
    #     isReadOnly = false;
    #   };
    # };
  };
}
