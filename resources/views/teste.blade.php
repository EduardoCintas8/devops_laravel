<?php

use Livewire\Component;

new class extends Component {
    public int $count = 0;

    public string $nome = '';

    public function increment(): void
    {
        $this->count++;
    }

    public function decrement(): void
    {
        if ($this->count > 0) {
            $this->count--;
        }
    }

    public function resetCount(): void
    {
        $this->count = 0;
    }
};

?>

<div>
    <!-- HERO -->
    <div class="bg-dark text-white p-5 mb-4 rounded">
        <div class="container">
            <h1 class="display-5 fw-bold">Painel de teste</h1>
            <p class="col-md-8 fs-5">
                Tela com Livewire + Bootstrap. Interações em tempo real sem recarregar a página.
            </p>

            <div class="d-flex flex-wrap align-items-center gap-3">
                <span class="badge bg-primary fs-6">Contador: {{ $count }}</span>

                <button wire:click="increment" type="button" class="btn btn-primary">
                    + Incrementar
                </button>
                <button wire:click="decrement" type="button" class="btn btn-outline-light">
                    − Decrementar
                </button>
                <button wire:click="resetCount" type="button" class="btn btn-outline-warning">
                    Zerar
                </button>
            </div>
        </div>
    </div>

    <!-- CARDS -->
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title">Estatísticas</h5>
                        <p class="card-text mb-0">
                            Valor atual do contador: <strong>{{ $count }}</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title">Usuários</h5>
                        <p class="card-text">Gerencie usuários cadastrados.</p>
                        <button type="button" class="btn btn-outline-success">Gerenciar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title">Configurações</h5>
                        <p class="card-text">Ajuste preferências do sistema.</p>
                        <button type="button" class="btn btn-outline-dark">Configurar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORMULÁRIO -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Formulário reativo</h5>

                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Seu nome</label>
                        <input wire:model.live="nome" type="text" id="nome" class="form-control"
                            placeholder="Digite seu nome">
                    </div>
                    <div class="col-md-6">
                        @if ($nome !== '')
                            <p class="mb-0 text-muted">
                                Olá, <strong>{{ $nome }}</strong>!
                            </p>
                        @else
                            <p class="mb-0 text-muted">O preview aparece ao digitar.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- TABELA -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Últimos registros</h5>

                <table class="table table-striped mb-0">
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
                            <td><button type="button" class="btn btn-sm btn-primary">Ver</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Maria</td>
                            <td><span class="badge bg-danger">Inativo</span></td>
                            <td><button type="button" class="btn btn-sm btn-primary">Ver</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
