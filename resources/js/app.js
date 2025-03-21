import './bootstrap';
import Chart from 'chart.js/auto';

window.Chart = Chart;

/**
 * Creates a simple Chart.js line chart with the given temperature readings.
 *
 * @param id
 * @param temperatureReadings
 */
window.Chart.simpleFactory = function(id, temperatureReadings) {
    const context = document.getElementById(id).getContext('2d');
    const labels = temperatureReadings.map(entry => {
        const date = new Date(entry.time);
        return date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    });
    const temperatures = temperatureReadings.map(entry => parseFloat(entry.temperature));

    new Chart(context, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Temperature (°C)',
                data: temperatures,
                borderColor: 'rgb(0,0,0)',
                borderWidth: 2,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: false }
            }
        }
    });
}

/**
 * Extracts user timezone and stores it in a cookie.
 */
document.addEventListener('DOMContentLoaded', function() {
    const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.cookie = `user_timezone=${timezone}; path=/; max-age=86400`;
});

