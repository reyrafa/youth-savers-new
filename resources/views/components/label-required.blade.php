<label {{$attributes->merge(['class'=> "block text-sm"])}}>
    {{ $value ?? $slot }} <span class="text-red-900 font-bold">*</span>
</label>