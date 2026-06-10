<?php

namespace App\Services;

class WelcomeService
{
    /**
     * @var array<string, string>
     */
    private array $moodMessages = [
        'feliz' => 'Que energia boa! Vamos construir algo incrível hoje.',
        'focado' => 'Modo foco ativado. Pipeline limpo, mente afiada.',
        'curioso' => 'Curiosidade é o combustível do DevOps. Explore sem medo.',
    ];

    public function timeBasedGreeting(): string
    {
        $hour = (int) now()->format('H');

        return match (true) {
            $hour < 12 => 'Bom dia',
            $hour < 18 => 'Boa tarde',
            default => 'Boa noite',
        };
    }

    public function personalizedGreeting(?string $name): string
    {
        $greeting = $this->timeBasedGreeting();

        if ($name === null || trim($name) === '') {
            return $greeting.'! Bem-vindo ao Devops DUDU 🚀';
        }

        return $greeting.', '.trim($name).'! Bem-vindo ao Devops DUDU 🚀';
    }

    public function moodMessage(string $mood): string
    {
        return $this->moodMessages[$mood] ?? $this->moodMessages['feliz'];
    }

    /**
     * @return array<string, string>
     */
    public function availableMoods(): array
    {
        return [
            'feliz' => '😄 Feliz',
            'focado' => '🎯 Focado',
            'curioso' => '🔍 Curioso',
        ];
    }

    public function boostMessage(int $clicks): string
    {
        return match (true) {
            $clicks === 0 => 'Clique no foguete para dar o pontapé inicial!',
            $clicks < 5 => 'Subindo... cada clique é um deploy na direção certa.',
            $clicks < 10 => 'Ótimo ritmo! Seu ambiente está aquecendo.',
            default => 'Foguete no ar! Você já domina essa vibe DevOps.',
        };
    }
}
