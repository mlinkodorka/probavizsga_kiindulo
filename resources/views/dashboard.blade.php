<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark text-center">
            {{ __('Számalk-Szalézi technikum és Szakgimnázium 2020-2022 évfolyam szoftverfejlesztőinek szakdolgozatai') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Reszponzív táblázat -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover border">
                            <thead class="table-dark">
                                <tr>
                                    <th>Szakdolgozat címe</th>
                                    <th>Készítők neve</th>
                                    <th>GitHub link</th>
                                    <th>Szakdolgozat elérhetősége</th>
                                    <th>Műveletek</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- Dinamikusan betöltött tartalom -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Űrlap az adatok hozzáadásához és módosításához -->
                    <div class="ujadat mt-4">
                        <form>
                            <input type="hidden" id="id">

                            <div class="mb-3 row">
                                <label for="szakdoga_nev" class="col-sm-3 col-form-label">Szakdolgozat címe</label>
                                <div class="col-sm-9">
                                    <input type="text" id="szakdoga_nev" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="tagokneve" class="col-sm-3 col-form-label">Készítők neve</label>
                                <div class="col-sm-9">
                                    <input type="text" id="tagokneve" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="oldallink" class="col-sm-3 col-form-label">Az oldal elérhetősége</label>
                                <div class="col-sm-9">
                                    <input type="text" id="oldallink" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="githublink" class="col-sm-3 col-form-label">GitHub elérhetőség</label>
                                <div class="col-sm-9">
                                    <input type="text" id="githublink" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-start gap-2">
                                <button type="button" id="uj" class="btn btn-primary">Új</button>
                                <button type="button" id="modosit" class="btn btn-warning">Módosít</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            function fetchTableData() {
                $('#table-body').html('<tr><td colspan="5">Betöltés...</td></tr>');
                $.ajax({
                    url: '/api/szakdogak',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        let rows = '';
                        data.forEach(item => {
                            rows += `
                            <tr>
                                <td>${item.szakdoga_nev}</td>
                                <td>${item.tagokneve}</td>
                                <td><a href="${item.githublink}" target="_blank">${item.githublink}</a></td>
                                <td><a href="${item.oldallink}" target="_blank">${item.oldallink}</a></td>
                                <td>
                                    <button class="edit btn btn-warning btn-sm" data-id="${item.id}">Módosítás</button>
                                    <button class="delete btn btn-danger btn-sm" data-id="${item.id}">Törlés</button>
                                </td>
                            </tr>
                            `;
                        });
                        $('#table-body').html(rows);
                        attachEventHandlers();
                    },
                    error: function () {
                        $('#table-body').html('<tr><td colspan="5">Hiba a betöltés során</td></tr>');
                    }
                });
            }

            function attachEventHandlers() {
                $('.delete').on('click', function () {
                    const id = $(this).data('id');
                    if (confirm('Biztosan törölni szeretnéd?')) {
                        $.ajax({
                            url: `/api/szakdogak/${id}`,
                            type: 'DELETE',
                            success: function () {
                                alert('Sikeres törlés!');
                                fetchTableData();
                            },
                            error: function () {
                                alert('Hiba a törlés során.');
                            }
                        });
                    }
                });

                $('.edit').on('click', function () {
                    const id = $(this).data('id');
                    $.get(`/api/szakdogak/${id}`, function (data) {
                        $('#id').val(data.id);
                        $('#szakdoga_nev').val(data.szakdoga_nev);
                        $('#tagokneve').val(data.tagokneve);
                        $('#oldallink').val(data.oldallink);
                        $('#githublink').val(data.githublink);
                    });
                });
            }

            $('#uj').on('click', function () {
                const szakdogaNev = $('#szakdoga_nev').val();
                const tagokNeve = $('#tagokneve').val();
                const oldalLink = $('#oldallink').val();
                const githubLink = $('#githublink').val();

                if (!szakdogaNev || !tagokNeve || !oldalLink || !githubLink) {
                    alert('Minden mező kitöltése kötelező!');
                    return;
                }

                $.post('/api/szakdogak', {
                    szakdoga_nev: szakdogaNev,
                    tagokneve: tagokNeve,
                    oldallink: oldalLink,
                    githublink: githubLink
                }).done(function () {
                    alert('Sikeres hozzáadás!');
                    fetchTableData();
                }).fail(function () {
                    alert('Hiba a hozzáadás során.');
                });
            });

            $('#modosit').on('click', function () {
                const id = $('#id').val();
                const szakdogaNev = $('#szakdoga_nev').val();
                const tagokNeve = $('#tagokneve').val();
                const oldalLink = $('#oldallink').val();
                const githubLink = $('#githublink').val();

                if (!id) {
                    alert('Nincs kiválasztott adat a módosításhoz!');
                    return;
                }

                $.ajax({
                    url: `/api/szakdogak/${id}`,
                    type: 'PUT',
                    data: {
                        szakdoga_nev: szakdogaNev,
                        tagokneve: tagokNeve,
                        oldallink: oldalLink,
                        githublink: githubLink
                    },
                    success: function () {
                        alert('Sikeres módosítás!');
                        fetchTableData();
                    },
                    error: function () {
                        alert('Hiba a módosítás során.');
                    }
                });
            });

            fetchTableData();
        });
    </script>
</x-app-layout>
