@component('mail::message')
# Reset Kata Sandi
 
Anda menerima email ini karena meminta untuk penyetelan ulang kata sandi akun Anda


 
@component('mail::button', ['url' => $url])
Reset Kata Sandi
@endcomponent

Link diatas akan kedaluwarsa dalam 60 menit.

Jika Anda tidak meminta pengaturan ulang kata sandi, tidak ada tindakan lebih lanjut yang diperlukan.
 
Salam,<br>
ExtraJoss

@slot('subcopy')
@lang(
    
    "Jika Anda kesulitan mengklik tombol Reset Kata Sandi , salin dan tempel URL di bawah ini ke\n". 'browser web Anda:',
) 
<span class="break-all">{{ $url }}?{{ $email }}</span>
@endslot
@endcomponent