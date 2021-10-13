@if(session()->has('alert'))
    @php
        $alert = session()->get('alert');
    @endphp
    <script>
        function main() {
            const defaultOptions = {
                type: 'success',
                text: '',
                layout: 'bottomRight',
                timeout: 3000,
                closeWith: ['click', 'button'],
            }
            const options = Object.assign(defaultOptions, @json($alert));
            new Noty(options).show();
        }
        document.addEventListener('DOMContentLoaded', main)
    </script>
@endif
