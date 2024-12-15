<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Számalk-Szalézi technikum és Szakgimnázium 2020-2022 évfolyam szoftverfejlesztőinek szakdolgozatai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="szakdolgozatoklistazasa">
                        <table class="table lista">
                            <thead class="fejlec">
                                <tr>
                                    <th scope="col" class="szakdogacime">Szakdolgozat címe</th>
                                    <th scope="col" class="tagok">Készítők neve</th>
                                    <th scope="col" class="githublink">GitHub link</th>
                                    <th scope="col" class="oldallink">Szakdolgozat elérhetősége</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr> -->
                            </tbody>
                        </table>


                    </div>


                    <div class="ujadat">
                        <form>
                            <div style="display:none"><input type="text" id="id"></div>
                            <div class="sor"><label for="szakdoga_nev">Szakdolgozat címe</label><input type="text" id="szakdoga_nev"></div>
                            <div class="sor"><label for="tagokneve">Készítők neve</label><input type="text" id="tagokneve"></div>
                            <div class="sor"><label for="oldallink">Az oldal elérhetősége </label><input type="text" id="oldallink"></div>
                            <div class="sor"><label for="githublink"> GitHub elérhetőség</label><input type="text" id="githublink"></div>
                            <div class="gomb"><button id="uj">Új</button>
                                <button id="modosit">Módosít</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // Fetch and display table data
            function fetchTableData() {
                $('#table-body').html('<tr><td colspan="4">Loading...</td></tr>');
                $.ajax({
                    url: '/api/szakdogak',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let rows = '';
                        data.forEach(item => {
                            rows += `
                        <tr>
                            <td>${item.szakdoga_nev}</td>
                            <td>${item.tagokneve}</td>
                            <td><a href="${item.githublink}" target="_blank">${item.githublink}</a></td>
                            <td><a href="${item.oldallink}" target="_blank">${item.oldallink}</a></td>
                        </tr>
                    `;
                        });
                        $('#table-body').html(rows);
                    },
                    error: function(xhr, status, error) {
                        $('#table-body').html('<tr><td colspan="4">Error loading data</td></tr>');
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // Call the function to load data on page load
            fetchTableData();

            // Handle "Új" button click
            $('#uj').on('click', function(event) {
                event.preventDefault();
                const szakdogaNev = $('#szakdoga_nev').val().trim();
                const tagokNeve = $('#tagokneve').val().trim();
                const oldalLink = $('#oldallink').val().trim();
                const githubLink = $('#githublink').val().trim();

                if (!szakdogaNev || !tagokNeve || !oldalLink || !githubLink) {
                    alert('All fields are required.');
                    return;
                }

                $.ajax({
                    url: '/api/szakdogak',
                    type: 'POST',
                    data: {
                        szakdoga_nev: szakdogaNev,
                        tagokneve: tagokNeve,
                        oldallink: oldalLink,
                        githublink: githubLink
                    },
                    success: function(response) {
                        alert('Data added successfully!');
                        fetchTableData(); // Refresh the table
                    },
                    error: function(xhr, status, error) {
                        console.error('Error adding data:', error);
                    }
                });
            });
        });
    </script>
</x-app-layout>