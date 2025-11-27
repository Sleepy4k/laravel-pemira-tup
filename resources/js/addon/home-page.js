document.addEventListener('DOMContentLoaded', function() {
    const barEl = document.getElementById('barChart');
    if (barEl) {
        const barData = barEl.getAttribute('data-chart') || '[]';
        const barCategories = barEl.getAttribute('data-categories') || '[]';
        window.renderChart(barEl, {
            series: JSON.parse(barData),
            chart: {
                type: "line",
                height: 350,
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0
                },
            },
            title: {
                text: 'Votes Per Candidate',
                align: 'left',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#F98825"],
            xaxis: {
                categories: JSON.parse(barCategories),
                labels: {
                    style: {
                        colors: "#616161",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400,
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "#616161ff",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400,
                    },
                },
            },
            grid: {
                show: true,
                borderColor: "#dddddd",
                strokeDashArray: 5,
                padding: {
                    top: 5,
                    right: 20,
                },
            },
            legend: {
                position: 'top'
            },
            tooltip: {
                theme: "dark"
            },
        });
    }

    const pieEl = document.getElementById('pieChart');
    if (pieEl) {
        const pieData = JSON.parse(pieEl.getAttribute('data-chart') || '{}');
        const colorPalette = ['#36A2EB', '#4BC0C0', '#9966FF', '#FF9F40'];

        window.renderChart(pieEl, {
            chart: {
                type: 'pie',
                height: 350,
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0
                },
            },
            title: {
                text: 'Overall Voting Status',
                align: 'left',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            },
            series: Object.values(pieData)?.map(val => parseInt(val)),
            labels: Object.keys(pieData),
            colors: colorPalette,
            legend: {
                position: 'bottom',
            },
        });
    }

    const barEl2 = document.getElementById('barChart2');
    if (barEl2) {
        const barData = barEl2.getAttribute('data-chart') || '[]';
        const barCategories = barEl2.getAttribute('data-categories') || '[]';

        window.renderChart(barEl2, {
            series: JSON.parse(barData),
            chart: {
                type: "bar",
                height: 350,
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0
                },
            },
            title: {
                text: 'Votes Per Batch Session',
                align: 'left',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#10B981", "#EF4444"],
            xaxis: {
                categories: JSON.parse(barCategories),
                labels: {
                    style: {
                        colors: "#616161",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400,
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "#616161ff",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400,
                    },
                },
            },
            grid: {
                show: true,
                borderColor: "#dddddd",
                strokeDashArray: 5,
                padding: {
                    top: 5,
                    right: 20,
                },
            },
            legend: {
                position: 'top'
            },
            tooltip: {
                theme: "dark"
            },
        });
    }

    const pieEl2 = document.getElementById('pieChart2');
    if (pieEl2) {
        const pieData = JSON.parse(pieEl2.getAttribute('data-chart') || '{}');
        window.renderChart(pieEl2, {
            chart: {
                type: 'pie',
                height: 350,
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0
                },
            },
            title: {
                text: 'Overall Voter Status',
                align: 'left',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            },
            series: [pieData.hasVoted, pieData.notVoted],
            labels: ['Has Voted', 'Not Voted'],
            colors: ['#10B981', '#EF4444'],
            legend: {
                position: 'bottom',
            },
        });
    }
});
