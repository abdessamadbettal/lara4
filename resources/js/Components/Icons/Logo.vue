<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="logo-svg text-gray-800 dark:text-red-400 h-16 transition-all duration-500 hover:rotate-1"
        viewBox="0 0 280 100"
        aria-label="Lara4 Logo"
    >
        <!-- Gradients with enhanced colors -->
        <defs>
            <linearGradient id="mainGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color: #EF4444; stop-opacity: 1" />
                <stop offset="50%" style="stop-color: #E11D48; stop-opacity: 1" />
                <stop offset="100%" style="stop-color: #DC2626; stop-opacity: 0.9" />
            </linearGradient>
            <linearGradient id="numberGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color: #6366F1; stop-opacity: 1" />
                <stop offset="50%" style="stop-color: #4F46E5; stop-opacity: 1" />
                <stop offset="100%" style="stop-color: #4338CA; stop-opacity: 0.9" />
            </linearGradient>
            <!-- Glow filter for hover effect -->
            <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                <feGaussianBlur in="SourceGraphic" stdDeviation="3" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="glow" />
                <feBlend in="SourceGraphic" in2="glow" mode="normal" />
            </filter>
        </defs>

        <!-- Enhanced code-like background with subtle pattern -->
        <!-- <rect x="5" y="10" width="270" height="55" fill="none" 
              class="stroke-current opacity-5" stroke-width="2" rx="6" /> -->
        
        <!-- Code pattern lines for decoration -->
        <line x1="8" y1="32" x2="272" y2="32" class="stroke-current opacity-5" stroke-width="0.5" />
        <line x1="8" y1="42" x2="272" y2="42" class="stroke-current opacity-5" stroke-width="0.5" />
        
        
        <!-- Main text with improved animations -->
        <g class="main-text">
            <text
                x="15"
                y="52"
                font-family="'JetBrains Mono', monospace"
                font-weight="700"
                font-size="42"
                letter-spacing="-1"
                class="tracking-tight"
            >
                <tspan fill="url(#mainGradient)" class="text-lara">
                    Lara</tspan
                ><tspan fill="url(#numberGradient)" class="text-number fill-black dark:fill-white"
                    >4</tspan
                >
            </text>
        </g>


        <!-- Animated dots -->
        <circle cx="240" cy="25" r="2" class="fill-current dot dot-1" />
        <circle cx="248" cy="25" r="2" class="fill-current dot dot-2" />
        <circle cx="256" cy="25" r="2" class="fill-current dot dot-3" />

        <!-- Enhanced tagline with code tags -->
        <text
            x="17"
            y="80"
            font-family="'JetBrains Mono', monospace"
            font-size="11"
            class="fill-current opacity-90 tagline"
        >
            &lt;Laravel starter kit/&gt;
        </text>
    </svg>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap');

/* Enhanced animations */
@keyframes slide-in {
    0% { 
        opacity: 0;
        transform: translateX(-15px);
    }
    100% { 
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse {
    0%, 100% { 
        opacity: 0.4;
        transform: scale(1);
    }
    50% { 
        opacity: 1;
        transform: scale(1.2);
    }
}

@keyframes subtle-float {
    0%, 100% { 
        transform: translateY(0);
    }
    50% { 
        transform: translateY(-1px);
    }
}

@keyframes bracket-fade {
    0% { 
        opacity: 0;
    }
    50% { 
        opacity: 0.2;
    }
    100% { 
        opacity: 0.4;
    }
}

/* Element animations */
.text-lara {
    animation: slide-in 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    transition: all 0.3s ease;
}

.text-number {
    animation: slide-in 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
    opacity: 0;
    transition: all 0.3s ease;
}

.brackets {
    animation: bracket-fade 1s ease-out 0.8s forwards;
    opacity: 0;
}

.dot {
    animation: pulse 2s infinite;
}

.dot-1 {
    animation-delay: 0s;
}

.dot-2 {
    animation-delay: 0.4s;
}

.dot-3 {
    animation-delay: 0.8s;
}

.tagline {
    animation: subtle-float 3s ease-in-out infinite;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.tagline:hover {
    opacity: 1;
    transform: translateY(-2px);
}

/* Hover interactions */
.text-lara:hover, .text-number:hover {
    filter: url(#glow);
    transform: scale(1.05);
}

.main-text:hover .text-lara {
    transform: translateX(-2px) scale(1.02);
}

.main-text:hover .text-number {
    transform: translateX(2px) scale(1.08);
}

/* Logo overall effects */
.logo-svg {
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.logo-svg:hover {
    filter: drop-shadow(0 0 8px rgba(239, 68, 68, 0.3));
    transform: rotate(1deg) scale(1.02);
}

.logo-svg:focus {
    outline: 2px solid rgba(239, 68, 68, 0.5);
    outline-offset: 3px;
}

/* Dark mode enhancements */
@media (prefers-color-scheme: dark) {
    .logo-svg:hover {
        filter: drop-shadow(0 0 12px rgba(239, 68, 68, 0.4));
    }
}
</style>