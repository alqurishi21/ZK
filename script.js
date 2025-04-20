

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const messageSent = document.getElementById('messageSent');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // منع الإرسال الافتراضي للنموذج

        // يمكنك هنا إضافة المزيد من التحقق من صحة الإدخال إذا لزم الأمر

        const formData = new FormData(form);

        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // عرض الاستجابة من PHP (للتطوير)
            form.style.display = 'none'; // إخفاء النموذج
            messageSent.classList.remove('hidden'); // إظهار رسالة النجاح
        })
        .catch(error => {
            console.error('حدث خطأ:', error);
            alert('حدث خطأ أثناء الإرسال. يرجى المحاولة مرة أخرى.');
        });
    });
});
