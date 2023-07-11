<?php
class PrimaryMenuMobile extends Walker_Nav_Menu
{

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $output .= $indent . '<li>';
        $output .= '<a class="text-lg" href="' . $item->url . '">' . $item->title . '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }
}
