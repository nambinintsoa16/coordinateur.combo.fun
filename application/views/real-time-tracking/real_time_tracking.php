<div class="p-3">
    <div class="row d-flex align-items-stretch h-100">
        <div class="col-12 col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-start fs-4">
                        <div class="mx-3">
                            Etat previsionnel
                        </div>
                        <div class="mx-3">
                            500000 MGA
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="profile">
                            <div class="profile-image d-flex justify-content-between align-items-end">
                                <div class="image mx-3 mt-10">
                                    <img src="../../assets/images/profil.jpg" alt="" width="100">
                                    <div class="text-center">2</div>
                                    <div class="place-name text-center">Jonathan</div>
                                    <div class="place-name text-center">250000 MGA</div>
                                </div>
                                <div class="image mx-3 mb-5">
                                    <img src="../../assets/images/profil.jpg" alt="" width="100">
                                    <div class="text-center">1</div>
                                    <div class="place-name text-center">Manoa</div>
                                    <div class="place-name text-center">225000 MGA</div>
                                </div>
                                <div class="image mx-3 mt-5">
                                    <img src="../../assets/images/profil.jpg" alt="" width="100">
                                    <div class="text-center">3</div>
                                    <div class="place-name text-center">Sitraka</div>
                                    <div class="place-name text-center">175000MGA</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-stretch h-100">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-body">
                    <table class="table table-sm table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>Rang</th>
                                <th>Nom</th>
                                <th>Page</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Jonathan</td>
                                <td>Zah Manja</td>
                                <td>250 000 MGA</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sitraka</td>
                                <td>Zah Manja</td>
                                <td>200 000 MGA</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Manoa</td>
                                <td>Zah Manja</td>
                                <td>150 000 MGA</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Jonathan</td>
                                <td>Zah Manja</td>
                                <td>250 000 MGA</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Sitraka</td>
                                <td>Zah Manja</td>
                                <td>200 000 MGA</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Manoa</td>
                                <td>Zah Manja</td>
                                <td>150 000 MGA</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Styles DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>
<!-- DataTables French language file -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.11.6/i18n/French.json"></script>

<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            autoFill: true,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.6/i18n/French.json"
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Zah Manja', 'Tia manimanitra', 'Zah jejo', 'Tarehy manjamanja'],
                datasets: [{
                    label: 'Montant en MGA',
                    data: [250000, 200000, 175000, 105000],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
