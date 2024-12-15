<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szakdoga Management</title>
</head>
<body>
    <div id="szakdoga-container"></div>

    <div class="ujadat">
        <form id="szakdoga-form">
            <div style="display:none"><input type="text" id="id"></div>
            <div class="sor"><label for="szakdoga_nev">Szakdolgozat címe</label><input type="text" id="szakdoga_nev"></div>
            <div class="sor"><label for="tagokneve">Készítők neve</label><input type="text" id="tagokneve"></div>
            <div class="sor"><label for="oldallink">Az oldal elérhetősége </label><input type="text" id="oldallink"></div>
            <div class="sor"><label for="githublink"> GitHub elérhetőség</label><input type="text" id="githublink"></div>
            <div class="gomb">
                <button type="button" id="uj">Új</button>
                <button type="button" id="modosit">Módosít</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/ajax.js') }}"></script>
    <script src="{{ asset('js/szakdoga.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // Fetch and display table data
            function fetchTableData() {
                $('#szakdoga-container').html('<tr><td colspan="4">Loading...</td></tr>');
                Ajax.get('/api/szakdogak').then(data => {
                    let rows = '';
                    data.forEach(item => {
                        const szakdoga = new Szakdoga(item.id, item.szakdoga_nev, item.tagokneve, item.oldallink, item.githublink);
                        $('#szakdoga-container').append(szakdoga.render());
                    });
                }).catch(error => {
                    $('#szakdoga-container').html('<tr><td colspan="4">Error loading data</td></tr>');
                    console.error('Error fetching data:', error);
                });
            }

            // Call the function to load data on page load
            fetchTableData();

            // Handle "Új" button click
            $('#uj').on('click', function(event) {
                event.preventDefault();
                const newData = {
                    szakdoga_nev: $('#szakdoga_nev').val(),
                    tagokneve: $('#tagokneve').val(),
                    oldallink: $('#oldallink').val(),
                    githublink: $('#githublink').val()
                };
                Ajax.post('/api/szakdogak', newData).then(() => {
                    alert('New record created successfully');
                    fetchTableData();
                }).catch(error => {
                    console.error('Error creating new record:', error);
                });
            });

            // Handle "Módosít" button click
            $('#modosit').on('click', function(event) {
                event.preventDefault();
                const id = $('#id').val();
                const updatedData = {
                    szakdoga_nev: $('#szakdoga_nev').val(),
                    tagokneve: $('#tagokneve').val(),
                    oldallink: $('#oldallink').val(),
                    githublink: $('#githublink').val()
                };
                Ajax.put(`/api/szakdogak/${id}`, updatedData).then(() => {
                    alert('Record updated successfully');
                    fetchTableData();
                }).catch(error => {
                    console.error('Error updating record:', error);
                });
            });
        });
    </script>
</body>
</html>