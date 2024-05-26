// Cart Modal JS Codes
const cartModal = document.querySelector('#cart_modal');
const cartBtn = document.querySelector('#cart_btn');
const notificationModal = document.querySelector('#notification_modal');
const notificationBtn = document.querySelector('#alert_btn');
const closeBtn = document.querySelector('.modal_close_btn');


cartBtn.addEventListener('click', () => {
    cartModal.classList.toggle('active');
    if (notificationModal.classList.contains('active')) {
        notificationModal.classList.remove('active');
    }
})

closeBtn.addEventListener('click', () => {
    cartModal.classList.remove('active');
})
// Cart Modal JS Codes


// Notification Modal JS Codes
notificationBtn.addEventListener('click', () => {
    notificationModal.classList.toggle('active');
    if (cartModal.classList.contains('active')) {
        cartModal.classList.remove('active');
    }
})

closeBtn.addEventListener('click', () => {
    notificationModal.classList.remove('active');
})
// Notification Modal JS Codes


// window.addEventListener('click', (e) => {
//     if (e.target.id != 'cart_btn' || e.target.id != 'alert_btn') {
//         cartModal.classList.toggle('active');
//         notificationModal.classList.toggle('active');
//     }
//     if (e.target.id != 'cart_modal' || e.target.id != 'notification_modal') {
//         cartModal.classList.remove('active');
//         notificationModal.classList.remove('active');

//         console.log(e.target)
//     }
// })