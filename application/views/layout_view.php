<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jadwal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 pb-24">
    <div class="px-6 py-4 bg-white sticky top-0 z-30 flex justify-between items-center border-b border-gray-100 shadow-sm">
        <h1 class="text-2xl font-black text-blue-600 tracking-tight uppercase leading-none">
            <?= $hari_ini; ?>
        </h1>
        
        <div class="h-9 w-9 rounded-full bg-blue-50 flex items-center justify-center text-sm text-blue-600 font-bold border border-blue-100">
            <?= substr($this->session->userdata('nama'), 0, 1); ?>
        </div>
    </div>

    <!-- Panggil konten di sini -->
    <div class="px-5 py-4">
        <?php $this->load->view($content) ?>
    </div>

    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-50">
        <div class="grid grid-cols-4 py-3 h-16">

            <a href="<?= site_url('dashboard'); ?>" class="flex flex-col items-center justify-center <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'text-blue-600' : 'text-gray-400 hover:text-blue-500'; ?> transition duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1 transform group-hover:scale-110 transition duration-200" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span class="text-[10px] font-bold">Home</span>
            </a>

            <a href="<?= site_url('jadwal'); ?>" class="flex flex-col items-center justify-center <?= ($this->uri->segment(1) == 'jadwal') ? 'text-blue-600' : 'text-gray-400 hover:text-blue-500'; ?> transition duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1 transform group-hover:scale-110 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-[10px] font-medium">Jadwal</span>
            </a>

            <a href="<?= site_url('ruangan'); ?>" class="flex flex-col items-center justify-center <?= ($this->uri->segment(1) == 'ruangan') ? 'text-blue-600' : 'text-gray-400 hover:text-blue-500'; ?> transition duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1 transform group-hover:scale-110 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="text-[10px] font-medium">Ruangan</span>
            </a>

            <a href="<?= site_url('auth/logout'); ?>" class="flex flex-col items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1 transform group-hover:scale-110 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-[10px] font-medium">Logout</span>
            </a>

        </div>
    </div>

</body>
</html>