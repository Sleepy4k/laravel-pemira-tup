import ApexCharts from 'apexcharts';

window.ApexCharts = ApexCharts;
window.renderChart = function (el, options) {
    const nonce = document.querySelector('meta[property="csp-nonce"]')?.getAttribute('content') || '';
    options.chart = options.chart || {};
    options.chart.nonce = nonce;
    const chart = new ApexCharts(el, options);
    chart.render();
    return chart;
}
