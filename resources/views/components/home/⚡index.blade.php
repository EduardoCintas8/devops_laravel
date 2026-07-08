<?php

use App\Services\WelcomeService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app')] class extends Component {
    public string $name = '';

    public string $mood = 'feliz';

    public int $boosts = 0;

    public function mount(WelcomeService $welcomeService): void
    {
        $this->mood = array_key_first($welcomeService->availableMoods()) ?? 'feliz';
    }

    public function selectMood(string $mood, WelcomeService $welcomeService): void
    {
        if (! array_key_exists($mood, $welcomeService->availableMoods())) {
            return;
        }

        $this->mood = $mood;
    }

    public function boost(): void
    {
        $this->boosts++;
    }

    public function resetBoost(): void
    {
        $this->boosts = 0;
    }

    #[Computed]
    public function greeting(): string
    {
        return app(WelcomeService::class)->personalizedGreeting($this->name);
    }

    #[Computed]
    public function moodMessage(): string
    {
        return app(WelcomeService::class)->moodMessage($this->mood);
    }

    #[Computed]
    public function moods(): array
    {
        return app(WelcomeService::class)->availableMoods();
    }

    #[Computed]
    public function boostMessage(): string
    {
        return app(WelcomeService::class)->boostMessage($this->boosts);
    }
};

?>

@push('styles')
    <style>
        .welcome-page {
            position: relative;
            min-height: 100vh;
            isolation: isolate;
            background-color: #0f172a;
        }

        .welcome-page__backdrop {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
            background:
                radial-gradient(circle at top, rgba(99, 102, 241, 0.22), transparent 42%),
                radial-gradient(circle at 85% 75%, rgba(249, 115, 22, 0.18), transparent 38%),
                linear-gradient(160deg, #020617 0%, #0f172a 45%, #1e1b4b 100%);
        }

        .welcome-page__content {
            position: relative;
            z-index: 1;
            pointer-events: auto;
        }

        .welcome-page__hero-title {
            color: #f8fafc;
            text-shadow: 0 2px 16px rgba(0, 0, 0, 0.35);
        }

        .welcome-page__hero-subtitle {
            color: #cbd5e1;
        }

        .welcome-page__grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(148, 163, 184, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.07) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(circle at center, black 35%, transparent 100%);
        }

        .welcome-page__stars {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle, rgba(255, 255, 255, 0.85) 1px, transparent 1px),
                radial-gradient(circle, rgba(255, 255, 255, 0.55) 1px, transparent 1px),
                radial-gradient(circle, rgba(255, 255, 255, 0.35) 1px, transparent 1px);
            background-size: 320px 320px, 460px 460px, 620px 620px;
            background-position: 0 0, 120px 80px, 60px 200px;
            opacity: 0.35;
        }

        .welcome-page__orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: welcome-float 10s ease-in-out infinite;
        }

        .welcome-page__orb--indigo {
            top: -4rem;
            left: -3rem;
            width: 18rem;
            height: 18rem;
            background: rgba(99, 102, 241, 0.35);
        }

        .welcome-page__orb--orange {
            right: -5rem;
            bottom: 2rem;
            width: 20rem;
            height: 20rem;
            background: rgba(249, 115, 22, 0.28);
            animation-delay: -4s;
        }

        .welcome-page__badge {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.35), rgba(249, 115, 22, 0.35));
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #f8fafc;
            letter-spacing: 0.04em;
        }

        .welcome-page__card {
            background: #ffffff;
            color: #1e293b;
        }

        .welcome-page__card-title {
            color: #0f172a;
        }

        .welcome-page__card-muted {
            color: #64748b;
        }

        .welcome-page__mood-btn {
            color: #334155;
            border-color: #94a3b8;
            background-color: #ffffff;
            cursor: pointer;
            touch-action: manipulation;
            user-select: none;
        }

        .welcome-page__mood-btn:hover,
        .welcome-page__mood-btn:focus {
            color: #0f172a;
            background-color: #f1f5f9;
            border-color: #64748b;
        }

        .welcome-page__mood-btn.is-active {
            color: #ffffff;
            border-color: #0d6efd;
            background-color: #0d6efd;
        }

        .welcome-page__alert {
            background: #f8fafc;
            color: #334155;
            border-color: #e2e8f0;
        }

        .welcome-page__rocket {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .welcome-page__rocket-title {
            color: #f8fafc;
        }

        .welcome-page__rocket-text {
            color: #cbd5e1;
        }

        .welcome-page__boost {
            background: linear-gradient(135deg, #6366f1, #f97316);
            color: #ffffff;
        }

        .welcome-page__action-btn {
            cursor: pointer;
            touch-action: manipulation;
            user-select: none;
        }

        .welcome-page__action-btn:disabled {
            cursor: wait;
            opacity: 0.7;
        }

        @keyframes welcome-float {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(18px);
            }
        }
    </style>
@endpush

<div class="welcome-page">
    <div class="welcome-page__backdrop" aria-hidden="true">
        <div class="welcome-page__grid"></div>
        <div class="welcome-page__orb welcome-page__orb--indigo"></div>
        <div class="welcome-page__orb welcome-page__orb--orange"></div>
        <div class="welcome-page__stars"></div>
    </div>

    <div class="welcome-page__content container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="welcome-page__hero text-center mb-5">
                    <span class="badge welcome-page__badge rounded-pill mb-3 px-3 py-2">Devops DUDU 🚀</span>
                    <h1 class="display-5 fw-bold mb-3 welcome-page__hero-title">{{ $this->greeting }}</h1>
                    <p class="lead welcome-page__hero-subtitle mb-0">
                        Uma página simples para começar — personalize sua experiência abaixo.
                    </p>
                </div>

                <div class="card welcome-page__card border-0 shadow-lg mb-4">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-semibold mb-3 welcome-page__card-title">Como podemos te chamar?</h2>
                        <label for="name" class="form-label visually-hidden">Seu nome</label>
                        <input
                            wire:model.live.debounce.300ms="name"
                            type="text"
                            id="name"
                            class="form-control form-control-lg"
                            placeholder="Digite seu nome"
                            autocomplete="name"
                        >
                        <p class="welcome-page__card-muted small mt-2 mb-0">
                            A saudação acima muda em tempo real conforme você digita.
                        </p>
                    </div>
                </div>

                <div class="card welcome-page__card border-0 shadow-lg mb-4">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-semibold mb-3 welcome-page__card-title">Como você está hoje?</h2>
                        <div class="d-flex flex-wrap gap-2 mb-3" wire:key="mood-buttons">
                            @foreach ($this->moods as $key => $label)
                                <button
                                    wire:key="mood-{{ $key }}"
                                    wire:click="selectMood(@js($key))"
                                    wire:loading.attr="disabled"
                                    wire:target="selectMood"
                                    type="button"
                                    @class([
                                        'btn welcome-page__mood-btn',
                                        'is-active' => $mood === $key,
                                    ])
                                >
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                        <div class="alert welcome-page__alert border mb-0" role="status" wire:key="mood-message">
                            {{ $this->moodMessage }}
                        </div>
                    </div>
                </div>

                <div class="card welcome-page__rocket border-0 shadow-lg">
                    <div class="card-body p-4 text-center">
                        <h2 class="h5 fw-semibold mb-2 welcome-page__rocket-title">Impulso do foguete</h2>
                        <p class="welcome-page__rocket-text mb-4">{{ $this->boostMessage }}</p>

                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-3" wire:key="boost-actions">
                            <span class="badge welcome-page__boost fs-6 px-3 py-2" wire:key="boost-counter">
                                Boosts: {{ $boosts }}
                            </span>

                            <button
                                wire:key="boost-button"
                                wire:click="boost"
                                wire:loading.attr="disabled"
                                wire:target="boost"
                                type="button"
                                class="btn btn-warning btn-lg px-4 welcome-page__action-btn"
                            >
                                <span wire:loading.remove wire:target="boost">🚀 Impulsionar</span>
                                <span wire:loading wire:target="boost">Impulsionando...</span>
                            </button>

                            <button
                                wire:key="reset-boost"
                                wire:click="resetBoost"
                                wire:loading.attr="disabled"
                                wire:target="resetBoost"
                                type="button"
                                @class([
                                    'btn btn-outline-light welcome-page__action-btn',
                                    'd-none' => $boosts === 0,
                                ])
                                @disabled($boosts === 0)
                            >
                                Reiniciar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
