<?php
require_once("../config/header.php");
require_once("../config/navbar.php");
?>
<section class="section is-medium" id="conteudo">
    <div class="container" id="conteudo">
        <div id="stock" class="notification has-background-white">
            <h1 class="title">Dashboard do Estoque</h1>
            <hr>
            <div class="container-fluid">
                <canvas id="stockChart" style="height: 400px; width: 500px;"></canvas>
            </div>
        </div>
    </div>

     <!-- Painel com a Tabela -->
     <div id="lowStockPanel" class="notification has-background-danger-light" style="margin-top: 20px;">
            <h2 class="title is-4">Itens com Quantidade Abaixo do Mínimo</h2>
            <table class="table is-fullwidth is-striped" id="lowStockTable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Quantidade Mínima</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dados dinâmicos serão inseridos aqui -->
                </tbody>
            </table>
        </div>
    </div>
</section>




<script>
    async function fetchStockData() {
    const response = await fetch('../database/item/dash_get_item.php');
    const data = await response.json();

    const labels = data.map(item => item.nome);
    const quantities = data.map(item => item.quantidade);
    const minQuantities = data.map(item => item.quantidade_minima);

    const backgroundColors = quantities.map((quantity, index) => {
        return quantity < minQuantities[index] ? 'rgba(255, 99, 132, 0.7)' : 'rgba(99, 230, 190, 0.7)';
    });
    const borderColors = quantities.map((quantity, index) => {
        return quantity < minQuantities[index] ? 'rgba(255, 99, 132, 1)' : 'rgba(99, 230, 190, 1)';
    });
    
    // Filtra os itens que estão abaixo do mínimo
    const lowStockItems = data.filter(item => item.quantidade < item.quantidade_minima);

    // Atualiza a tabela com os itens abaixo do mínimo
    const lowStockTable = document.getElementById('lowStockTable').querySelector('tbody');
    lowStockTable.innerHTML = ""; // Limpa o conteúdo anterior, se houver

    lowStockItems.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.nome}</td>
            <td>${item.quantidade}</td>
            <td>${item.quantidade_minima}</td>
        `;
        lowStockTable.appendChild(row);
    });

    const ctx = document.getElementById('stockChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Quantidade em Estoque',
                data: quantities,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    type: 'logarithmic',
                }
            }
        }
    });
}


    document.addEventListener('DOMContentLoaded', fetchStockData);


    
</script>
<?php
require_once("../config/footer.php");
?>