document.addEventListener("DOMContentLoaded",function(){window.{{ config('datatables-html.namespace', 'NakaDataTables') }}=window.{{ config('datatables-html.namespace', 'NakaDataTables') }}||{};window.{{ config('datatables-html.namespace', 'NakaDataTables') }}["%1$s"]=$("#%1$s").DataTable(%2$s);});
@foreach ($scripts as $script)
@include($script)
@endforeach
