<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app')] class extends Component {
    //
};

?>

@push('styles')
    <style>
        .dudu-page {
            --mouse-x: 50%;
            --mouse-y: 50%;
            --glow-x: 50%;
            --glow-y: 50%;
            --trail-x: 50%;
            --trail-y: 50%;
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            isolation: isolate;
            background-color: #020617;
            cursor: crosshair;
        }

        .dudu-page__layer {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .dudu-page__grid {
            background-image:
                linear-gradient(rgba(148, 163, 184, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.06) 1px, transparent 1px);
            background-size: 56px 56px;
            background-position: calc(var(--mouse-x) * 0.02) calc(var(--mouse-y) * 0.02);
            mask-image: radial-gradient(circle at var(--mouse-x) var(--mouse-y), black 12%, transparent 72%);
            transition: background-position 0.08s linear;
        }

        .dudu-page__glow {
            background: radial-gradient(
                circle 420px at var(--glow-x) var(--glow-y),
                rgba(99, 102, 241, 0.28),
                rgba(249, 115, 22, 0.12) 38%,
                transparent 70%
            );
        }

        .dudu-page__trail {
            background: radial-gradient(
                circle 180px at var(--trail-x) var(--trail-y),
                rgba(56, 189, 248, 0.18),
                transparent 70%
            );
        }

        .dudu-page__stars {
            background-image:
                radial-gradient(circle, rgba(255, 255, 255, 0.9) 1px, transparent 1px),
                radial-gradient(circle, rgba(255, 255, 255, 0.45) 1px, transparent 1px);
            background-size: 280px 280px, 420px 420px;
            background-position:
                calc(var(--mouse-x) * -0.08) calc(var(--mouse-y) * -0.08),
                calc(var(--mouse-x) * 0.05) calc(var(--mouse-y) * 0.05);
            opacity: 0.35;
            transition: background-position 0.12s linear;
        }

        .dudu-page__ring {
            position: absolute;
            width: 28rem;
            height: 28rem;
            border: 1px solid rgba(148, 163, 184, 0.14);
            border-radius: 50%;
            left: var(--glow-x);
            top: var(--glow-y);
            transform: translate(-50%, -50%);
            transition: left 0.18s ease-out, top 0.18s ease-out;
        }

        .dudu-page__ring--inner {
            width: 14rem;
            height: 14rem;
            left: var(--trail-x);
            top: var(--trail-y);
            border-color: rgba(99, 102, 241, 0.35);
            transition: left 0.32s ease-out, top 0.32s ease-out;
        }

        .dudu-page__content {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .dudu-page__title {
            margin: 0;
            font-size: clamp(3.5rem, 14vw, 9rem);
            font-weight: 700;
            letter-spacing: 0.22em;
            text-indent: 0.22em;
            line-height: 1;
            text-align: center;
            filter: drop-shadow(0 0 calc(20px + var(--title-glow, 0) * 30px) rgba(99, 102, 241, 0.45));
            transform: perspective(800px) rotateX(calc((var(--mouse-y) - 50) * 0.06deg)) rotateY(calc((var(--mouse-x) - 50) * -0.06deg));
            transition: transform 0.12s ease-out, filter 0.12s ease-out;
            user-select: none;
        }

        .dudu-page__title span {
            display: inline-block;
            color: transparent;
            background: linear-gradient(
                120deg,
                #f8fafc 0%,
                #a5b4fc 35%,
                #f97316 70%,
                #f8fafc 100%
            );
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            animation: dudu-shimmer 6s ease-in-out infinite;
        }

        [x-cloak] {
            display: none !important;
        }

        @keyframes dudu-shimmer {
            0%,
            100% {
                background-position: 0% center;
            }

            50% {
                background-position: 200% center;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .dudu-page__grid,
            .dudu-page__stars,
            .dudu-page__ring,
            .dudu-page__title {
                transition: none;
                animation: none;
            }
        }
    </style>
@endpush

<div
    class="dudu-page"
    wire:ignore
    x-data="duduTechHero()"
    x-init="init()"
    @mousemove="onMouseMove($event)"
    @mouseleave="onMouseLeave()"
    :style="pageStyle"
>
    <div class="dudu-page__layer dudu-page__glow"></div>
    <div class="dudu-page__layer dudu-page__trail"></div>
    <div class="dudu-page__layer dudu-page__grid"></div>
    <div class="dudu-page__layer dudu-page__stars"></div>

    <div class="dudu-page__layer">
        <div class="dudu-page__ring"></div>
        <div class="dudu-page__ring dudu-page__ring--inner"></div>
    </div>

    <div class="dudu-page__content">
        <h1 class="dudu-page__title">
            <span>DUDU TECH</span>
        </h1>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('duduTechHero', () => ({
                mouseX: 50,
                mouseY: 50,
                glowX: 50,
                glowY: 50,
                trailX: 50,
                trailY: 50,
                titleGlow: 0,
                frame: null,

                get pageStyle() {
                    return `
                        --mouse-x: ${this.mouseX}%;
                        --mouse-y: ${this.mouseY}%;
                        --glow-x: ${this.glowX}%;
                        --glow-y: ${this.glowY}%;
                        --trail-x: ${this.trailX}%;
                        --trail-y: ${this.trailY}%;
                        --title-glow: ${this.titleGlow};
                    `;
                },

                init() {
                    this.animate();
                },

                onMouseMove(event) {
                    const rect = this.$el.getBoundingClientRect();
                    const x = ((event.clientX - rect.left) / rect.width) * 100;
                    const y = ((event.clientY - rect.top) / rect.height) * 100;

                    this.mouseX = Math.max(0, Math.min(100, x));
                    this.mouseY = Math.max(0, Math.min(100, y));
                    this.titleGlow = 1 - Math.min(1, Math.hypot(x - 50, y - 50) / 50);
                },

                onMouseLeave() {
                    this.titleGlow = 0;
                },

                animate() {
                    this.glowX += (this.mouseX - this.glowX) * 0.14;
                    this.glowY += (this.mouseY - this.glowY) * 0.14;
                    this.trailX += (this.mouseX - this.trailX) * 0.07;
                    this.trailY += (this.mouseY - this.trailY) * 0.07;

                    this.frame = requestAnimationFrame(() => this.animate());
                },

                destroy() {
                    if (this.frame) {
                        cancelAnimationFrame(this.frame);
                    }
                },
            }));
        });
    </script>
@endpush
