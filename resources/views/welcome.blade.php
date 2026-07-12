<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="NyoUniverse - Professional Admin Dashboard">
    <meta name="author" content="NyoUniverse">
    <title>{{ config('app.name', 'NyoUniverse') }} - Welcome</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/welcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-p0Lh5K6W3sPsP/4u1B7YU2fysydnEDx7vWIXJThpDHVoj4D4qY6hVLh4r+G7lPnKZx0HTWf0L0E0uJ6VY6bYlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
        }

        .gradient-accent {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-shadow {
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.14);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-18px); }
        }

        .float-soft {
            animation: float 6s ease-in-out infinite;
        }

        .button-glow {
            box-shadow: 0 18px 40px rgba(124, 58, 237, 0.25);
        }
    </style>
</head>
<body class="min-h-screen text-slate-100">
    <nav class="fixed inset-x-0 top-0 z-50 border-b border-slate-800/70 bg-slate-950/95 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-r from-indigo-500 to-sky-500 text-white shadow-xl shadow-slate-950/20">
                    <i class="fas fa-cube"></i>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-slate-400">{{ config('app.name', 'NyoUniverse') }}</p>
                    <p class="text-base font-semibold text-white">Calibration Admin</p>
                </div>
            </div>

            <div class="hidden items-center gap-6 md:flex">
                <a href="#features" class="text-slate-300 transition hover:text-white">Features</a>
                <a href="#workflow" class="text-slate-300 transition hover:text-white">Workflow</a>
                <a href="#contact" class="text-slate-300 transition hover:text-white">Contact</a>
                <a href="/admin" class="inline-flex items-center rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:opacity-95">
                    <i class="fas fa-sign-in-alt mr-2"></i>Admin Panel
                </a>
            </div>
        </div>
    </nav>

    <main class="relative overflow-hidden pt-28">
        <div class="absolute left-0 top-0 h-72 w-72 rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute right-0 top-24 h-64 w-64 rounded-full bg-sky-500/10 blur-3xl"></div>

        <section class="relative mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8">
            <div class="grid gap-16 lg:grid-cols-2 lg:items-center">
                <div class="space-y-8">
                    <span class="inline-flex rounded-full bg-slate-800/80 px-4 py-1 text-xs font-semibold uppercase tracking-[0.32em] text-sky-300">Built for regulated industry</span>
                    <h1 class="max-w-3xl text-5xl font-bold tracking-tight text-white sm:text-6xl lg:text-7xl">
                        Simplify calibration, qualification, and mapping with a modern admin experience.
                    </h1>
                    <p class="max-w-2xl text-lg leading-8 text-slate-300">
                        NyoUniverse combines clean data workflows, role-based approvals, and intuitive monitoring so your team can stay compliant without complexity.
                    </p>

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <a href="/admin" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-7 py-4 text-base font-semibold text-white transition hover:brightness-110 button-glow">
                            <i class="fas fa-rocket mr-3"></i>Explore Admin
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center rounded-full border border-slate-700 bg-slate-900/80 px-7 py-4 text-base font-semibold text-slate-200 transition hover:bg-slate-900">
                            <i class="fas fa-info-circle mr-3"></i>See Features
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div class="rounded-[2rem] border border-white/10 bg-slate-900/90 p-8 shadow-2xl shadow-slate-950/40 backdrop-blur-xl">
                        <div class="space-y-6">
                            <div class="rounded-3xl bg-slate-800/80 p-6 shadow-xl shadow-slate-950/20">
                                <p class="text-sm uppercase tracking-[0.35em] text-sky-300">Dashboard preview</p>
                                <h2 class="mt-4 text-3xl font-semibold text-white">Live Program Overview</h2>
                                <p class="mt-3 text-slate-400">Manage upcoming calibration and qualification schedules with confidence.</p>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-3xl bg-slate-950/80 p-5">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Upcoming</p>
                                    <p class="mt-4 text-3xl font-semibold text-white">24</p>
                                    <p class="mt-2 text-sm text-slate-400">Approved tasks in the next 3 months</p>
                                </div>
                                <div class="rounded-3xl bg-slate-950/80 p-5">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Activity</p>
                                    <p class="mt-4 text-3xl font-semibold text-white">98%</p>
                                    <p class="mt-2 text-sm text-slate-400">Completion consistency across teams</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 left-0 h-40 w-40 rounded-full bg-sky-500/10 blur-3xl"></div>
                    <div class="absolute -top-8 right-8 h-24 w-24 rounded-full bg-indigo-500/10 blur-3xl"></div>
                </div>
            </div>
        </section>

        <section id="features" class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-400">Features</p>
                <h2 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl">Everything your admin team needs.</h2>
                <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-slate-400">A polished admin experience with clean tables, consistent workflows, and fast navigation.</p>
            </div>

            <div class="mt-16 grid gap-6 lg:grid-cols-3">
                <article class="rounded-[2rem] border border-slate-800/80 bg-slate-950/90 p-8 text-slate-100 card-shadow transition hover:-translate-y-1 hover:border-indigo-500/30">
                    <span class="inline-flex items-center rounded-full bg-indigo-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-indigo-300">Manage</span>
                    <h3 class="mt-6 text-2xl font-semibold text-white">Centralized data management</h3>
                    <p class="mt-4 text-slate-400">Keep Master Data, Programs, and Execution records connected in one consistent admin dashboard.</p>
                </article>

                <article class="rounded-[2rem] border border-slate-800/80 bg-slate-950/90 p-8 text-slate-100 card-shadow transition hover:-translate-y-1 hover:border-sky-500/30">
                    <span class="inline-flex items-center rounded-full bg-sky-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-sky-300">Approve</span>
                    <h3 class="mt-6 text-2xl font-semibold text-white">Role-based approvals</h3>
                    <p class="mt-4 text-slate-400">Enable managers and technicians to approve workflows securely and transparently.</p>
                </article>

                <article class="rounded-[2rem] border border-slate-800/80 bg-slate-950/90 p-8 text-slate-100 card-shadow transition hover:-translate-y-1 hover:border-violet-500/30">
                    <span class="inline-flex items-center rounded-full bg-violet-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-violet-300">Report</span>
                    <h3 class="mt-6 text-2xl font-semibold text-white">Clear insights</h3>
                    <p class="mt-4 text-slate-400">Easily review schedules, outcomes, and audit trails through intuitive reporting sections.</p>
                </article>
            </div>
        </section>

        <section id="workflow" class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-3">
                <div class="rounded-[2rem] border border-slate-800/80 bg-slate-950/90 p-10 shadow-2xl shadow-slate-950/20">
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Workflow</p>
                    <h2 class="mt-6 text-3xl font-bold text-white">Designed for high compliance teams.</h2>
                    <p class="mt-6 text-slate-400 leading-8">NyoUniverse guides teams through planning, approval, and execution with a consistent UI that reduces error and improves adoption.</p>
                </div>
                <div class="space-y-6">
                    <div class="rounded-[1.75rem] border border-slate-800/80 bg-slate-950/90 p-8 shadow-xl text-slate-100">
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-indigo-500/10 text-indigo-300">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-semibold text-white">Plan programs</h3>
                        <p class="mt-3 text-slate-400">Set yearly calibration, qualification, and mapping plans with intelligent filters.</p>
                    </div>
                    <div class="rounded-[1.75rem] border border-slate-800/80 bg-slate-950/90 p-8 shadow-xl text-slate-100">
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-sky-500/10 text-sky-300">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-semibold text-white">Approve reliably</h3>
                        <p class="mt-3 text-slate-400">Give reviewers a clean interface for approvals, with clear next steps and status tracking.</p>
                    </div>
                    <div class="rounded-[1.75rem] border border-slate-800/80 bg-slate-950/90 p-8 shadow-xl text-slate-100">
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-violet-500/10 text-violet-300">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-semibold text-white">Track results</h3>
                        <p class="mt-3 text-slate-400">Record execution and review outcomes with a system built for auditability.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="mx-auto max-w-7xl px-4 pb-24 sm:px-6 lg:px-8">
            <div class="rounded-[2rem] border border-slate-800/80 bg-slate-950/90 p-12 shadow-2xl shadow-slate-950/20">
                <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.35em] text-sky-300">Ready to improve your process?</p>
                        <h2 class="mt-4 text-3xl font-bold text-white">Start using NyoUniverse today.</h2>
                        <p class="mt-4 max-w-2xl text-slate-400 leading-7">Access your admin panel now to manage schedules, approvals, and compliance data in a modern dashboard.</p>
                    </div>
                    <a href="/admin" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-8 py-4 text-base font-semibold text-white transition hover:brightness-110">
                        <i class="fas fa-arrow-right mr-3"></i>Open Admin Panel
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-800/80 bg-slate-950/95 py-10 text-slate-400">
        <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 sm:px-6 lg:px-8 lg:flex-row lg:items-center lg:justify-between">
            <p class="text-sm">&copy; {{ date('Y') }} {{ config('app.name', 'NyoUniverse') }}. Designed for modern calibration and compliance teams.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="text-slate-400 transition hover:text-white"><i class="fab fa-github"></i></a>
                <a href="#" class="text-slate-400 transition hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-slate-400 transition hover:text-white"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
