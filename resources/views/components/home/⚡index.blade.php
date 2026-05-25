<?php

use Livewire\Component;

new class extends Component {
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }
};

?>

<div>
    <!-- HERO -->
    <div class="bg-dark text-white p-5 mb-4 rounded">
        <div class="container">
            <h1 class="display-5 fw-bold">Bem-vindo, Eduardo 🚀</h1>
            <p class="col-md-8 fs-5">
                Painel inicial do sistema com Livewire + Bootstrap.
                Aqui você pode gerenciar tudo em tempo real.
            </p>

            <button wire:click="increment" class="btn btn-primary btn-lg">
            </button>
        </div>
    </div>

    <!-- CARDS -->
    <div class="container">
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">📊 Estatísticas</h5>
                        <p class="card-text">Visualize dados do sistema em tempo real.</p>
                        <button class="btn btn-outline-primary">Ver mais</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">👤 Usuários</h5>
                        <p class="card-text">Gerencie usuários cadastrados.</p>
                        <button class="btn btn-outline-success">Gerenciar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">⚙️ Configurações</h5>
                        <p class="card-text">Ajuste preferências do sistema.</p>
                        <button class="btn btn-outline-dark">Configurar</button>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABELA -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">📋 Últimos registros</h5>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>João</td>
                            <td><span class="badge bg-success">Ativo</span></td>
                            <td><button class="btn btn-sm btn-primary">Ver</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Maria</td>
                            <td><span class="badge bg-danger">Inativo</span></td>
                            <td><button class="btn btn-sm btn-primary">Ver</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>