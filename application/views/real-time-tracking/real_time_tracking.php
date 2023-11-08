
    <style>
        .card .card-header, .card-light .card-header {
            padding: 1rem 1.25rem;
            background-color: transparent;
            border-bottom: 1px solid #ebecec!important;
        }

        .place {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 10px;
            flex-grow: 1;
        }

        .left {
            background-color: silver;
        }

        .middle {
            background-color: gold;
        }

        .right {
            background-color: #cd7f32;
        }


    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            Etat previsionnel
                        </div>
                        <div>
                            Ar 256 000 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-12 col-md-6 d-flex my-sm-3">
                <div class="card h-100 w-100">
                    <div class="card-header">
                        Etat previsionnel par page
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex my-sm-3">
                <div class="card h-100">
                    <div class="card-header">
                            Top 3
                    </div>
                    <div class="card-body">
                        <div class="podium d-flex justify-content-between align-items-end">
                            <div class="place left mx-3">
                                <h1>2nd Place</h1>
                                <p>Silver Medal</p>
                            </div>
                            <div class="place middle mx-3">
                                <h1>1st Place</h1>
                                <p>Gold Medal</p>
                            </div>
                            <div class="place right mx-3">
                                <h1>3rd Place</h1>
                                <p>Bronze Medal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header">
                            Tableau
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/plugin/chart.js/chart.min.js'); ?>"></script>
    
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        // Fonction pour mettre à jour les données du graphique
        function updateChartData() {
            // Données de mock mises à jour (remplacez-les par vos propres données)
            var mockData = {
                'Page 1': Math.floor(Math.random() * 2000),  // Exemple : des chiffres aléatoires
                'Page 2': Math.floor(Math.random() * 2000),
                'Page 3': Math.floor(Math.random() * 2000),
                'Page 4': Math.floor(Math.random() * 2000),
                'Page 5': Math.floor(Math.random() * 2000),
                // Ajoutez d'autres données ici
            };

            chart.data.labels = Object.keys(mockData); // Mettre à jour les noms des pages
            chart.data.datasets[0].data = Object.values(mockData); // Mettre à jour les chiffres d'affaires

            chart.update(); // Mettre à jour le graphique
        }

        // Données de mock (remplacez-les par vos propres données)
        var mockData = {
            'Page 1': 1000,
            'Page 2': 1500,
            'Page 3': 2000,
            'Page 4': 1200,
            'Page 5': 1800,
            // Ajoutez d'autres données ici
        };

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(mockData), // Noms des pages en X
                datasets: [{
                    label: 'Chiffre d\'affaires',
                    data: [], // Chiffres d'affaires en Y
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Mettez à jour les données du graphique toutes les 5 minutes (300 000 millisecondes)
        setInterval(updateChartData, 10000);
    </script>





