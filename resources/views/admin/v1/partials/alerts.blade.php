@if (session('success'))
<x-admin.v1.modals.alerts.success title="{{__('alerts.success_title')}}" btnTitle="{{__('alerts.success_button')}}">
<x-slot name="description">
    {{ session('success') }}
</x-slot>
</x-admin.v1.modals.alerts.success>
@endif
@if (session('error'))
<x-admin.v1.modals.alerts.error title="{{__('alerts.error_title')}}" btnTitle="{{__('alerts.error_button')}}">
<x-slot name="description">
    {{ session('error') }}
</x-slot>
</x-admin.v1.modals.alerts.error>
@endif
<script>
    @foreach($errors->all() as $error)

        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("{{ $error }}");
    @endforeach
</script>


