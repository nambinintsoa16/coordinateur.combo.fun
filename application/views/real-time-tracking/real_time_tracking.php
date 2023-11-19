<div class="p-3">
    <!-- Modal -->
    <div class="modal fade" id="donutChartModal" tabindex="-1" role="dialog" aria-labelledby="donutChartModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="donutChartModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <canvas id="donutChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

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
                        <div id="etat-total" class="mx-3"></div>
                    </div>
                    <div class="mt-5">
                        <div class="profile">
                            <div class="profile-image d-flex justify-content-between align-items-end">
                                <div class="image mx-3 mt-10">
                                    <div class="d-flex justify-content-center">
                                        <img src="../../assets/images/profil.jpg" alt="" width="100">
                                    </div>
                                    <div class="text-center">2</div>
                                    <div id="second-name" class="place-name text-center"></div>
                                    <div id="second-total" class="place-name text-center"></div>
                                </div>
                                <div class="image mx-3 mb-5">
                                    <div class="d-flex justify-content-center">
                                        <img src="../../assets/images/profil.jpg" alt="" width="100">
                                    </div>
                                    <div class="text-center">1</div>
                                    <div id="first-name" class="place-name text-center"></div>
                                    <div id="first-total" class="place-name text-center"></div>
                                </div>
                                <div class="image mx-3 mt-5">
                                    <div class="d-flex justify-content-center">
                                        <img src="../../assets/images/profil.jpg" alt="" width="100">
                                    </div>
                                    <div class="text-center">3</div>
                                    <div id="third-name" class="place-name text-center"></div>
                                    <div id="third-total" class="place-name text-center"></div>
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
                                <th>Operatrice</th>
                                <th>Nom</th>
                                <th>Pages utlisees</th>
                                <th>Nombre de pages</th>
                                <th>Total (MGA)</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclure Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Styles DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables French Language -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/json/fr-FR.json'); ?>"></script>
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>
<!-- DataTables French language file -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.11.6/i18n/French.json"></script>

<script>
    // Déclarer la variable socket en dehors de la fonction onload
    var socket;

    // Charger Socket.IO de manière traditionnelle
    var script = document.createElement('script');
    script.src = 'https://cdn.socket.io/4.6.0/socket.io.min.js';

    // Attendre que le script soit chargé avant d'initialiser la connexion Socket.IO
    script.onload = function () {
        socket = io('http://localhost:3000');
    };

    document.head.appendChild(script);

    function formatNumberWithSpaces(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }

    function generateDonutColorsRGBA(numLabels, alpha = 0.5) {
        const colors = [];

        for (let i = 0; i < numLabels; i++) {
            const hue = (i * 360 / numLabels) % 360;
            const color = `hsla(${hue}, 70%, 50%, ${alpha})`;
            const rgbaColor = hslaToRgba(color);
            colors.push(rgbaColor);
        }

        return colors;
    }

    function hslaToRgba(hsla) {
        const [hue, sat, light, alpha] = hsla
            .substring(hsla.indexOf('(') + 1, hsla.lastIndexOf(')'))
            .split(',')
            .map((val) => parseFloat(val));

        const c = (1 - Math.abs(2 * light - 1)) * sat;
        const x = c * (1 - Math.abs((hue / 60) % 2 - 1));
        const m = light - c / 2;

        let red, green, blue;

        if (0 <= hue && hue < 60) {
            [red, green, blue] = [c, x, 0];
        } else if (60 <= hue && hue < 120) {
            [red, green, blue] = [x, c, 0];
        } else if (120 <= hue && hue < 180) {
            [red, green, blue] = [0, c, x];
        } else if (180 <= hue && hue < 240) {
            [red, green, blue] = [0, x, c];
        } else if (240 <= hue && hue < 300) {
            [red, green, blue] = [x, 0, c];
        } else {
            [red, green, blue] = [c, 0, x];
        }

        return `rgba(${Math.round((red + m) * 255)}, ${Math.round((green + m) * 255)}, ${Math.round((blue + m) * 255)}, ${alpha})`;
    }

    $(document).ready(function() {
        const year = new Date().getFullYear();
        const month = new Date().getMonth() + 1; 
        var donutChart;
        var mychart;
        $('.datatable').DataTable({
            autoFill: true,
            "language": {
                url: "<?php echo base_url('assets/json/fr-FR.json'); ?>"
            }
        });

        var tableau = $('.datatable').DataTable();

        $.get(
                base_url + "RealTimeTracking/getSaleByPage?month="+month+"&year=" +year,
                function (data) {
                    // Extraction des labels et des données pour les 15 meilleures ventes par page
                    var labels = data.map(function (entry) {
                        return entry.Nom_page;
                    });

                    var sumTotalData = data.map(function (entry) {
                        return entry.Somme_Total;
                    });

                    var staticColors = [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(162, 134, 149, 0.8)',
                        'rgba(23, 154, 79, 0.45)',
                        'rgba(253, 228, 32, 0.45)',
                        'rgba(221, 124, 53, 0.45)',
                        'rgba(143, 147, 202, 0.45)',
                        'rgba(134, 228, 221, 0.45)',
                        'rgba(176, 134, 228, 0.45)',
                        'rgba(219, 134, 228, 0.45)',
                        'rgba(248, 34, 77, 0.45)',
                        'rgba(151, 146, 147, 0.45)',
                        'rgba(255, 29, 0, 0.45)'
                    ];

                    // Configuration du graphique avec des options de mise en page
                    var ctx = $('#myChart')[0].getContext('2d');

                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [...labels],
                            datasets: [{
                                label: 'Les 15 meilleures pages de vente',
                                data: sumTotalData,
                                backgroundColor: staticColors,
                                borderColor: staticColors,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                x: {
                                    display: false,
                                    ticks: {
                                        autoSkip: false,
                                    },
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                       callback: function (value) {
                                        return formatNumberWithSpaces(value);
                                    },
                                    },
                                },
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            return ' Total :' + formatNumberWithSpaces(context.parsed.y) + ' MGA';
                                        },
                                    },
                                },
                            },
                        }
                    });
                }
		);
            
        $.get(
                base_url + "RealTimeTracking/getSaleByOperatrice?month="+month+"&year="+year,
                function (data) {
                    var somme = 0;
                    var total = data.map(x => {
                        somme+= parseInt(x.Somme_Ventes)
                    })

                    $('#etat-total').text(formatNumberWithSpaces(somme) + " MGA");
                    // Tableau de la page
                    if(data.length == 1) {
                        $('#first-name').text(data[0].Nom_operatrice);
                        $('#first-total').text(formatNumberWithSpaces(parseInt(data[0].Somme_Ventes)) + ' MGA');
                    } else if(data.length == 2) {
                        $('#first-name').text(data[0].Nom_operatrice);
                        $('#first-total').text(formatNumberWithSpaces(parseInt(data[0].Somme_Ventes)) + ' MGA');
                        $('#second-name').text(data[1].Nom_operatrice);
                        $('#second-total').text(formatNumberWithSpaces(parseInt(data[1].Somme_Ventes)) + ' MGA');
                    } else {
                        $('#first-name').text(data[0].Nom_operatrice);
                        $('#second-name').text(data[1].Nom_operatrice);
                        $('#third-name').text(data[2].Nom_operatrice);
                        $('#first-total').text(formatNumberWithSpaces(parseInt(data[0].Somme_Ventes)) + ' MGA');
                        $('#second-total').text(formatNumberWithSpaces(parseInt(data[1].Somme_Ventes)) + ' MGA');
                        $('#third-total').text(formatNumberWithSpaces(parseInt(data[2].Somme_Ventes)) + ' MGA');
                    }
                    
                    var tableau = $('.datatable').DataTable();

                    // Effacer toutes les lignes existantes
                    tableau.clear();

                    // Ajouter les nouvelles données
                    data.forEach(function (entry, index) {
                        tableau.row.add([
                            index + 1,
                            entry.operatrice,
                            entry.Nom_operatrice,
                            entry.Pages_utilisees.replace(/\n/g, '<br>').replace(/,/g, ''),
                            entry.Nbr_page,
                            formatNumberWithSpaces(parseInt(entry.Somme_Ventes))
                        ]).draw(false);
                    });
                }
        );



        socket.on("syncData", (data) => {
            if(data.save == true) {
                $.get(
                    base_url + "RealTimeTracking/getSaleByPage?month="+month+"&year=" +year,
                    function (data) {
                        // Extraction des labels et des données pour les 15 meilleures ventes par page
                        var labels = data.map(function (entry) {
                            return entry.Nom_page;
                        });

                        var sumTotalData = data.map(function (entry) {
                            return entry.Somme_Total;
                        });

                        var staticColors = [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(162, 134, 149, 0.8)',
                            'rgba(23, 154, 79, 0.45)',
                            'rgba(253, 228, 32, 0.45)',
                            'rgba(221, 124, 53, 0.45)',
                            'rgba(143, 147, 202, 0.45)',
                            'rgba(134, 228, 221, 0.45)',
                            'rgba(176, 134, 228, 0.45)',
                            'rgba(219, 134, 228, 0.45)',
                            'rgba(248, 34, 77, 0.45)',
                            'rgba(151, 146, 147, 0.45)',
                            'rgba(255, 29, 0, 0.45)'
                        ];

                        if (myChart) {
                            myChart.destroy();
                        }

                        // Configuration du graphique avec des options de mise en page
                        var ctx = $('#myChart')[0].getContext('2d');
                        myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [...labels],
                                datasets: [{
                                    label: 'Les 15 meilleures pages de vente',
                                    data: sumTotalData,
                                    backgroundColor: staticColors,
                                    borderColor: staticColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        display: false,
                                        ticks: {
                                            autoSkip: false,
                                        },
                                    },
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                        callback: function (value) {
                                            return formatNumberWithSpaces(value);
                                        },
                                        },
                                    },
                                },
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function (context) {
                                                return ' Total :' + formatNumberWithSpaces(context.parsed.y) + ' MGA';
                                            },
                                        },
                                    },
                                },
                            }
                        });
                    }
		        );
            
                $.get(
                    base_url + "RealTimeTracking/getSaleByOperatrice?month="+month+"&year="+year,
                    function (data) {
                            var somme = 0;
                            var total = data.map(x => {
                                somme+= parseInt(x.Somme_Ventes)
                            })

                            $('#etat-total').text(formatNumberWithSpaces(somme) + " MGA");
                            // Tableau de la page
                            if(data.length == 1) {
                                $('#first-name').text(data[0].Nom_operatrice);
                                $('#first-total').text(formatNumberWithSpaces(parseInt(data[0].Somme_Ventes)) + ' MGA');
                            } else if(data.length == 2) {
                                $('#first-name').text(data[0].Nom_operatrice);
                                $('#first-total').text(formatNumberWithSpaces(parseInt(data[0].Somme_Ventes)) + ' MGA');
                                $('#second-name').text(data[1].Nom_operatrice);
                                $('#second-total').text(formatNumberWithSpaces(parseInt(data[1].Somme_Ventes)) + ' MGA');
                            } else {
                                $('#first-name').text(data[0].Nom_operatrice);
                                $('#second-name').text(data[1].Nom_operatrice);
                                $('#third-name').text(data[2].Nom_operatrice);
                                $('#first-total').text(formatNumberWithSpaces(parseInt(data[0].Somme_Ventes)) + ' MGA');
                                $('#second-total').text(formatNumberWithSpaces(parseInt(data[1].Somme_Ventes)) + ' MGA');
                                $('#third-total').text(formatNumberWithSpaces(parseInt(data[2].Somme_Ventes)) + ' MGA');
                            }
                            
                            var tableau = $('.datatable').DataTable();

                            // Effacer toutes les lignes existantes
                            tableau.clear();

                            // Ajouter les nouvelles données
                            data.forEach(function (entry, index) {
                                tableau.row.add([
                                    index + 1,
                                    entry.operatrice,
                                    entry.Nom_operatrice,
                                    entry.Pages_utilisees.replace(/\n/g, '<br>').replace(/,/g, ''),
                                    entry.Nbr_page,
                                    formatNumberWithSpaces(parseInt(entry.Somme_Ventes))
                                ]).draw(false);
                            });
                    }
                );  
            }
        });

        $('.datatable tbody').on('click', 'tr', function () {
            var rowData = tableau.row(this).data();

            const operatrice = rowData[1];

            $('#donutChartModalLabel').text(rowData[2] + ": " + rowData[5] + " MGA");

            $.get(
                base_url + "RealTimeTracking/getSaleByOperatricePerYear?month="+month+"&year="+year+"&operatrice="+operatrice,
                function (data) {
                    // Créer un graphique en donut dans le modal
                    const labels = [];
                    const datasets = [];

                    data.map(x => {
                        labels.push(x.Nom_page);
                        datasets.push(x.Somme_Ventes_par_page);
                    });

                    const donutColorsRGBA = generateDonutColorsRGBA(labels.length);

                    if (donutChart) {
                        donutChart.destroy();
                    }

                    const donutChartCtx = $('#donutChart')[0].getContext('2d');
                    donutChart = new Chart(donutChartCtx, {
                        type: 'doughnut',
                        data: {
                            labels: labels, 
                            datasets: [{
                                data: datasets, 
                                backgroundColor: donutColorsRGBA
                            }]
                        },
                        options: {
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            return ' Total :' + formatNumberWithSpaces(parseInt(tooltipItem.raw)) + ' MGA';
                                        },
                                    },
                                },
                            },
                        }
                    });

                    // Ouvrir le modal
                    $('#donutChartModal').modal('show');
                }
            );
        });

        
    });
</script>
