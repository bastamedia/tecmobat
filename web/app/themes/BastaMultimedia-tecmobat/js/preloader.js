const wait = (delay = 0) =>
    new Promise(resolve => setTimeout(resolve, delay));

const setVisible = (elementOrSelector, visible) =>
    (typeof elementOrSelector === 'string'
            ? document.querySelector(elementOrSelector)
            : elementOrSelector
    ).classList.add(visible ? 'load' : 'page');

setVisible('body', false);

document.addEventListener('DOMContentLoaded', () =>
    wait(1700).then(() => {
        setVisible('body', true);
    }));
