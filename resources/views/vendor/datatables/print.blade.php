<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <title>Print Table</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @vite(['resources/css/app.css'])

        <style @cspNonce>
            @media print {
                .no-print {
                    display: none !important;
                }

                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                table th,
                table td {
                    border: 1px solid #000;
                    padding: 6px;
                }
            }

            body {
                padding: 1rem;
            }
        </style>
    </head>
    <body class="bg-gray-50 text-gray-800">
        <div class="no-print flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Data Table</h1>
            <div class="space-x-2">
                <button id="printButton"
                    class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded shadow cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6v-8z" />
                    </svg>
                    Print
                </button>
                <button id="closeButton"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded cursor-pointer">
                    Close
                </button>
            </div>
        </div>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 table-auto">
                @foreach ($data as $row)
                    @if ($loop->first)
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach ($row as $key => $value)
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        {!! $key !!}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                    @endif

                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                        @foreach ($row as $key => $value)
                            @if (is_string($value) || is_numeric($value))
                                <td class="px-4 py-3 text-sm text-gray-700">{!! $value !!}</td>
                            @else
                                <td class="px-4 py-3 text-sm text-gray-700"></td>
                            @endif
                        @endforeach
                    </tr>

                    @if ($loop->last)
                        </tbody>
                    @endif
                @endforeach
            </table>
        </div>

        <script @cspNonce>
            document.addEventListener('DOMContentLoaded', function() {
                const printButton = document.getElementById('printButton');
                if (printButton) {
                    printButton.addEventListener('click', function() {
                        window.print();
                    });
                }

                const closeButton = document.getElementById('closeButton');
                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        window.close();
                    });
                }
            });
        </script>
    </body>
</html>
