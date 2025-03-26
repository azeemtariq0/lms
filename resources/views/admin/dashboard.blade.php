@extends('layouts.app')


@section('content')
    <div class="w-1/2 bg-white p-2 rounded-lg border border-gray-300 ">
        <div class="flex items-center justify-between">
            <h1 class="pl-1 rounded-md">Users Analysis</h1>
            <button id="userChartYearFilter"
                class="btn-default !bg-gray-100 !text-gray-700 !font-medium border border-gray-300">1
                Year</button>

        </div>
        <canvas id="userChart"></canvas>
    </div>
@endsection

@section('pagelevelscript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {

            new Dropdown("#userChartYearFilter", {
                options: [{
                        value: 1,
                        label: "1 Year"
                    },
                    {
                        value: 2,
                        label: "2 Years"
                    },
                    {
                        value: 3,
                        label: "3 Years"
                    },
                    {
                        value: 4,
                        label: "4 Years"
                    },
                    {
                        value: 5,
                        label: "5 Years"
                    }
                ],
                onChange: function(option) {
                    userChart({
                        yearly: option.value
                    });
                }
            });
            let userChartInstance = null;

            function userChart(filters) {
                $.ajax({
                    url: "{{ url('admin/user-chart') }}",
                    type: "GET",
                    data: JSON.stringify(filters),
                    contentType: "application/json",
                    success: function(data) {
                        let months = data.map(item => `Month ${item.month}`);
                        let userCounts = data.map(item => item.count);

                        let ctx = document.getElementById("userChart").getContext("2d");

                        // Destroy existing chart to prevent overlay issues
                        if (userChartInstance !== null) {
                            userChartInstance.destroy();
                        }

                        userChartInstance = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: months,
                                datasets: [{
                                    tension: 0.4,
                                    label: "Users",
                                    data: userCounts,
                                    backgroundColor: "rgba(54, 162, 235, 0.5)",
                                    borderColor: "rgba(54, 162, 235, 1)",
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                });
            }

            // Initial Chart Load
            userChart({
                yearly: 1
            });
        });
    </script>
@endsection
