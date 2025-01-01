<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class=" py-2 position: fixed; left: 0; top: 50%; transform: translateY(-50%);">
        <x-menu></x-menu>
    </div>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee List</title>

        <!-- Include Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <!-- Include Flowbite -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flowbite@1.5.2/dist/flowbite.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body class="bg-gray-100 font-sans">

        <div class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-lg">

            <button class="btn-fetch bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="fetchEmployees()">
                Fetch Employees
            </button>

            <table id="employeeTable" class="mt-6 w-full table-auto border-collapse">
                <thead>
                    <tr id="tableHeader" class="bg-gray-200">
                        <!-- Column headers will be dynamically added here -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be dynamically inserted here -->
                </tbody>
            </table>
        </div>

        <script>
            function fetchEmployees() {
                $.ajax({
                    url: 'http://localhost:5112/api/Employees/', // Replace with your actual endpoint
                    type: 'GET',
                    success: function(data) {
                        $('#employeeTable thead #tableHeader').empty();
                        $('#employeeTable tbody').empty();

                        if (data.length > 0) {
                            const keys = Object.keys(data[0]);

                            // Dynamically create column headers
                            keys.forEach(key => {
                                $('#employeeTable thead #tableHeader').append(`<th class="border px-4 py-2">${key}</th>`);
                            });

                            // Populate table rows
                            data.forEach(employee => {
                                let row = '<tr>';
                                keys.forEach(key => {
                                    row += `<td class="border px-4 py-2">${employee[key] || ''}</td>`;
                                });
                                row += '</tr>';
                                $('#employeeTable tbody').append(row);
                            });
                        } else {
                            $('#employeeTable tbody').append('<tr><td colspan="100%" class="text-center py-4">No employees found</td></tr>');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseJSON?.error || "Unknown error");
                        alert('Failed to fetch employee data.');
                    }
                });
            }
        </script>

    </body>
    </html>
</x-layout>
