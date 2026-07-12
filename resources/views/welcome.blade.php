<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="NyoUniverse - Professional Admin Dashboard">
    <meta name="author" content="NyoUniverse">
    <title>{{ config('app.name', 'NyoUniverse') }} - Welcome</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
            50% { box-shadow: 0 0 40px rgba(102, 126, 234, 0.8); }
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in {
            animation: slideIn 0.8s ease-out forwards;
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        
        .feature-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center">
                        <i class="fas fa-cube text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">{{ config('app.name', 'NyoUniverse') }}</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">Features</a>
                    <a href="#about" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">About</a>
                    <a href="/admin" class="gradient-bg text-white px-6 py-2.5 rounded-full font-medium hover:opacity-90 transition-opacity duration-200 shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login to Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 gradient-bg relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 slide-in">
                    Welcome to<br/>
                    <span class="text-yellow-300">{{ config('app.name', 'NyoUniverse') }}</span>
                </h1>
                <p class="text-xl text-white/90 mb-10 max-w-3xl mx-auto slide-in delay-100">
                    Professional admin dashboard built with modern technologies. 
                    Manage your data efficiently with our powerful and intuitive interface.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center slide-in delay-200">
                    <a href="/admin" class="group bg-white text-purple-700 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 shadow-2xl pulse-glow inline-flex items-center justify-center">
                        <i class="fas fa-rocket mr-2 group-hover:rotate-45 transition-transform duration-300"></i>
                        Get Started
                    </a>
                    <a href="#features" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/10 transition-all duration-300 inline-flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Learn More
                    </a>
                </div>
            </div>
            
            <!-- Floating Elements -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center float-animation" style="animation-delay: 0s;">
                    <i class="fas fa-bolt text-yellow-300 text-3xl mb-3"></i>
                    <p class="text-white font-semibold">Fast</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center float-animation" style="animation-delay: 1s;">
                    <i class="fas fa-shield-alt text-green-300 text-3xl mb-3"></i>
                    <p class="text-white font-semibold">Secure</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center float-animation" style="animation-delay: 2s;">
                    <i class="fas fa-mobile-alt text-blue-300 text-3xl mb-3"></i>
                    <p class="text-white font-semibold">Responsive</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center float-animation" style="animation-delay: 3s;">
                    <i class="fas fa-cogs text-purple-300 text-3xl mb-3"></i>
                    <p class="text-white font-semibold">Customizable</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Powerful Features</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Everything you need to manage your application efficiently
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="feature-icon w-14 h-14 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-tachometer-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Admin Dashboard</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Comprehensive dashboard with real-time analytics and insights to monitor your application performance.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-50 rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="feature-icon w-14 h-14 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-database text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Data Management</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Easy-to-use interface for managing your database records with CRUD operations and advanced filtering.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-50 rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="feature-icon w-14 h-14 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">User Management</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Complete user authentication and authorization system with role-based access control.
                    </p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-gray-50 rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="feature-icon w-14 h-14 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Analytics & Reports</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Generate detailed reports and visualize data with interactive charts and graphs.
                    </p>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-gray-50 rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="feature-icon w-14 h-14 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-plug text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Easy Integration</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Seamlessly integrate with third-party services and APIs to extend functionality.
                    </p>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-gray-50 rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="feature-icon w-14 h-14 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dedicated support team available around the clock to help you with any issues.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="about" class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-white/90 mb-10">
                Access your admin panel and start managing your application with ease.
            </p>
            <a href="/admin" class="inline-block bg-white text-purple-700 px-10 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 shadow-2xl">
                <i class="fas fa-arrow-right mr-2"></i>
                Go to Admin Panel
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center">
                            <i class="fas fa-cube text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-bold">{{ config('app.name', 'NyoUniverse') }}</span>
                    </div>
                    <p class="text-gray-400">
                        Professional admin dashboard for modern applications.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                        <li><a href="/admin" class="text-gray-400 hover:text-white transition-colors">Admin Panel</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'NyoUniverse') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Auto redirect script (optional, can be removed if you want users to explore first) -->
    <script>
        // Optional: Auto-redirect after 10 seconds
        // setTimeout(() => {
        //     window.location.href = '/admin';
        // }, 10000);
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
