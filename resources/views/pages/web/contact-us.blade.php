@extends('layouts.web')

@section('content')
  <div class="space-y-4">
    <h1 class="font-bold text-base border-b border-slate-300 pb-4">Contact Us</h1>
    <div class="space-y-4">
      <h1 class="font-semibold text-center">C. Salva St., Poblacion, Opol, Misamis Oriental</h1>
      <div class="flex items-center justify-around gap-4 max-sm:flex-col">
        <div class="flex items-center gap-2">
          <i data-lucide="mail" class="size-5 text-[#AD0404]" stroke-width="1.5"></i>
          <a href="mailto:thekatatauresearchjournal@occ.edu.ph" target="_blank"
            class="font-semibold hover:text-[#AD0404]">thekatatauresearchjournal@occ.edu.ph
          </a>
        </div>
        <div class="flex items-center gap-2">
          <i data-lucide="phone" class="size-5 text-[#AD0404]" stroke-width="1.5"></i>
          <a href="tel:+639171281320" target="_blank" class="font-semibold hover:text-[#AD0404]">+63 917 128 1320</a>
        </div>
      </div>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.7907150589745!2d124.56930427506468!3d8.519689796753294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32fff45c293f18b5%3A0x1731022a1fa237d2!2sC.%20Salva%20St%2C%20Poblacion%2C%20Opol%2C%20Misamis%20Oriental!5e0!3m2!1sen!2sph!4v1787901625892!5m2!1sen!2sph"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>
  </div>
@endsection