<?php
// Lista de tarefas definida em array PHP
$tarefas = [
    [
        'id' => 1,
        'texto' => 'Estudar para a prova de PHP',
        'status' => 'Pendente'
    ],
    [
        'id' => 2,
        'texto' => 'Implementar sistema de autenticação',
        'status' => 'Concluída'
    ],
    [
        'id' => 3,
        'texto' => 'Criar documentação do projeto',
        'status' => 'Em andamento'
    ],
    [
        'id' => 4,
        'texto' => 'Revisar código para otimização',
        'status' => 'Pendente'
    ],
    [
        'id' => 5,
        'texto' => 'Configurar servidor de produção',
        'status' => 'Concluída'
    ],
    [
        'id' => 6,
        'texto' => 'Implementar testes unitários',
        'status' => 'Em andamento'
    ],
    [
        'id' => 7,
        'texto' => 'Fazer backup do banco de dados',
        'status' => 'Pendente'
    ],
    [
        'id' => 8,
        'texto' => 'Atualizar dependências do projeto',
        'status' => 'Concluída'
    ]
];

// Função para obter classe CSS baseada no status
function obterClasseStatus($status) {
    switch (strtolower($status)) {
        case 'concluída':
            return 'status-concluida';
        case 'em andamento':
            return 'status-andamento';
        case 'pendente':
        default:
            return 'status-pendente';
    }
}

// Função para contar tarefas por status
function contarTarefasPorStatus($tarefas) {
    $contadores = [
        'total' => count($tarefas),
        'concluida' => 0,
        'andamento' => 0,
        'pendente' => 0
    ];
    
    foreach ($tarefas as $tarefa) {
        switch (strtolower($tarefa['status'])) {
            case 'concluída':
                $contadores['concluida']++;
                break;
            case 'em andamento':
                $contadores['andamento']++;
                break;
            case 'pendente':
                $contadores['pendente']++;
                break;
        }
    }
    
    return $contadores;
}

$estatisticas = contarTarefasPorStatus($tarefas);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Tarefas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 30px;
            background: #f8f9fa;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-total .stat-number { color: #3498db; }
        .stat-concluida .stat-number { color: #27ae60; }
        .stat-andamento .stat-number { color: #f39c12; }
        .stat-pendente .stat-number { color: #e74c3c; }

        .tasks-section {
            padding: 30px;
        }

        .section-title {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .tasks-grid {
            display: grid;
            gap: 20px;
        }

        .task-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .task-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            transition: width 0.3s ease;
        }

        .task-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .task-card:hover::before {
            width: 8px;
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .task-id {
            background: #f8f9fa;
            color: #6c757d;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .task-texto {
            font-size: 1.1rem;
            color: #2c3e50;
            line-height: 1.6;
            margin-bottom: 15px;
            flex-grow: 1;
            margin-right: 15px;
        }

        .task-status {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .status-pendente {
            background: #fee;
            color: #e74c3c;
            border: 1px solid #fadbd8;
        }

        .status-pendente::before {
            background: #e74c3c;
        }

        .status-concluida {
            background: #eafaf1;
            color: #27ae60;
            border: 1px solid #d5f4e6;
        }

        .status-concluida::before {
            background: #27ae60;
        }

        .status-andamento {
            background: #fef9e7;
            color: #f39c12;
            border: 1px solid #fcf3cf;
        }

        .status-andamento::before {
            background: #f39c12;
        }

        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .stats {
                grid-template-columns: repeat(2, 1fr);
                padding: 20px;
            }
            
            .tasks-section {
                padding: 20px;
            }
            
            .task-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .task-texto {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }

        .loading-animation {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Sistema de Gerenciamento de Tarefas</h1>
            <p>Desenvolvido em PHP - Avaliação Acadêmica</p>
        </header>

        <section class="stats">
            <div class="stat-card stat-total">
                <div class="stat-number"><?php echo $estatisticas['total']; ?></div>
                <div class="stat-label">Total de Tarefas</div>
            </div>
            <div class="stat-card stat-concluida">
                <div class="stat-number"><?php echo $estatisticas['concluida']; ?></div>
                <div class="stat-label">Concluídas</div>
            </div>
            <div class="stat-card stat-andamento">
                <div class="stat-number"><?php echo $estatisticas['andamento']; ?></div>
                <div class="stat-label">Em Andamento</div>
            </div>
            <div class="stat-card stat-pendente">
                <div class="stat-number"><?php echo $estatisticas['pendente']; ?></div>
                <div class="stat-label">Pendentes</div>
            </div>
        </section>

        <section class="tasks-section">
            <h2 class="section-title">Lista de Tarefas</h2>
            <div class="tasks-grid">
                <?php foreach ($tarefas as $index => $tarefa): ?>
                    <div class="task-card loading-animation" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <div class="task-header">
                            <span class="task-id">Tarefa #<?php echo $tarefa['id']; ?></span>
                            <span class="task-status <?php echo obterClasseStatus($tarefa['status']); ?>">
                                <?php echo htmlspecialchars($tarefa['status']); ?>
                            </span>
                        </div>
                        <div class="task-texto">
                            <?php echo htmlspecialchars($tarefa['texto']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <footer class="footer">
            <p>&copy; <?php echo date('Y'); ?> Sistema de Tarefas PHP | Desenvolvido para avaliação acadêmica | 
            <a href="https://github.com/GMorosini/ifes-ec2/" target="_blank">Código no GitHub</a></p>
        </footer>
    </div>

    <script>
        // Adicionar interatividade e animações
        document.addEventListener('DOMContentLoaded', function() {
            // Animação de contadores
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalNumber = parseInt(stat.textContent);
                let currentNumber = 0;
                const increment = finalNumber / 30;
                
                const timer = setInterval(() => {
                    currentNumber += increment;
                    if (currentNumber >= finalNumber) {
                        stat.textContent = finalNumber;
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(currentNumber);
                    }
                }, 50);
            });

            // Efeito de hover nos cards de tarefa
            const taskCards = document.querySelectorAll('.task-card');
            taskCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.borderColor = '#667eea';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.borderColor = '#e9ecef';
                });
            });

            // Filtro por status (funcionalidade adicional)
            let currentFilter = 'all'; // Estado inicial: mostrar todas as tarefas

            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('click', function() {
                    let newFilter = 'all';
                    const className = this.className;
                    
                    if (className.includes('stat-concluida')) {
                        newFilter = 'concluída';
                    } else if (className.includes('stat-andamento')) {
                        newFilter = 'em andamento';
                    } else if (className.includes('stat-pendente')) {
                        newFilter = 'pendente';
                    }

                    // Se o filtro clicado for o mesmo que o atual, desativa o filtro
                    if (newFilter === currentFilter && newFilter !== 'all') {
                        currentFilter = 'all';
                    } else {
                        currentFilter = newFilter;
                    }
                    
                    console.log('Filtro atual:', currentFilter);

                    taskCards.forEach(taskCard => {
                        const statusElement = taskCard.querySelector('.task-status');
                        // Normaliza o texto do status para comparação
                        const taskStatus = statusElement.textContent.toLowerCase().trim();
                        
                        console.log('Tarefa ID:', taskCard.querySelector('.task-id').textContent, 'Status:', taskStatus, 'Comparando com:', currentFilter);

                        if (currentFilter === 'all' || taskStatus === currentFilter) {
                            taskCard.style.display = 'block';
                            taskCard.style.opacity = '1';
                        } else {
                            taskCard.style.display = 'none';
                            taskCard.style.opacity = '0';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>