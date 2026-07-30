<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl md:text-3xl text-slate-800 dark:text-slate-100 leading-tight flex items-center gap-2">
                    <svg class="w-7 h-7 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Applications Support Activity Tracker
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 font-medium">
                    Shift handover & daily task monitoring system
                </p>
            </div>

            <!-- Header Actions: Theme Toggle + Log Activity Button -->
            <div class="flex items-center gap-3">
                <!-- Theme Toggle Button -->
                <button 
                    onclick="toggleTheme()" 
                    type="button"
                    class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 transition-all cursor-pointer"
                    title="Toggle Dark / Light Theme"
                >
                    <svg class="w-5 h-5 hidden dark:block text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg class="w-5 h-5 block dark:hidden text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>

                <!-- Header Action Button -->
                <button 
                    onclick="window.dispatchEvent(new CustomEvent('open-activity-modal'))" 
                    type="button"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm rounded-xl shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer ocean-btn"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Log New Activity
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Outer Alpine Wrapper managing New Modal & Edit Modal -->
    <div 
        x-data="{ 
            openModal: false, 
            openEditModal: false, 
            editData: { id: '', activity_title: '', description: '', status: 'Pending', remarks: '' } 
        }" 
        @open-activity-modal.window="openModal = true" 
        class="py-8 bg-slate-50/50 dark:bg-slate-950 min-h-screen text-base"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success Flash Message -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-sm font-semibold flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-600 dark:text-emerald-400 font-bold">&times;</button>
                </div>
            @endif

            <!-- ---------------------------------------------------------------- -->
            <!-- 1. KPI METRIC CARDS                                              -->
            <!-- ---------------------------------------------------------------- -->
            <!-- SUMMARY CARDS SECTION (4 COLUMNS) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

<!-- 1. TOTAL TRACKED (Indigo Theme) -->
<div class="group relative bg-slate-900/80 border border-slate-800/80 rounded-2xl p-5 transition-all duration-300 ease-in-out hover:-translate-y-1.5 hover:border-indigo-500/60 hover:shadow-xl hover:shadow-indigo-500/10 flex items-center justify-between overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

    <div>
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Total Tracked</p>
        <h3 class="text-3xl font-extrabold text-white group-hover:text-indigo-200 transition-colors duration-300">
            {{ $totalTracked ?? 9 }}
        </h3>
    </div>

    <div class="p-3 rounded-2xl bg-indigo-500/10 text-indigo-400 transition-all duration-300 ease-in-out group-hover:scale-110 group-hover:bg-indigo-500/20 group-hover:text-indigo-300 group-hover:shadow-[0_0_20px_rgba(99,102,241,0.4)]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
    </div>
</div>

<!-- 2. IN PROGRESS (Sky Blue / Cyan Theme) -->
<div class="group relative bg-slate-900/80 border border-slate-800/80 rounded-2xl p-5 transition-all duration-300 ease-in-out hover:-translate-y-1.5 hover:border-sky-500/60 hover:shadow-xl hover:shadow-sky-500/10 flex items-center justify-between overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-sky-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

    <div>
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">In Progress</p>
        <h3 class="text-3xl font-extrabold text-sky-400 group-hover:text-sky-200 transition-colors duration-300">
            {{ $inProgress ?? 2 }}
        </h3>
    </div>

    <div class="p-3 rounded-2xl bg-sky-500/10 text-sky-400 transition-all duration-300 ease-in-out group-hover:scale-110 group-hover:bg-sky-500/20 group-hover:text-sky-300 group-hover:shadow-[0_0_20px_rgba(14,165,233,0.4)]">
        <svg class="w-6 h-6 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
    </div>
</div>

<!-- 3. PENDING HANDOVER (Amber / Orange Theme) -->
<div class="group relative bg-slate-900/80 border border-slate-800/80 rounded-2xl p-5 transition-all duration-300 ease-in-out hover:-translate-y-1.5 hover:border-amber-500/60 hover:shadow-xl hover:shadow-amber-500/10 flex items-center justify-between overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

    <div>
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Pending Handover</p>
        <h3 class="text-3xl font-extrabold text-amber-500 group-hover:text-amber-300 transition-colors duration-300">
            {{ $pendingHandover ?? 2 }}
        </h3>
    </div>

    <div class="p-3 rounded-2xl bg-amber-500/10 text-amber-400 transition-all duration-300 ease-in-out group-hover:scale-110 group-hover:bg-amber-500/20 group-hover:text-amber-300 group-hover:shadow-[0_0_20px_rgba(245,158,11,0.4)]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </div>
</div>

<!-- 4. COMPLETED (Emerald / Green Theme) -->
<div class="group relative bg-slate-900/80 border border-slate-800/80 rounded-2xl p-5 transition-all duration-300 ease-in-out hover:-translate-y-1.5 hover:border-emerald-500/60 hover:shadow-xl hover:shadow-emerald-500/10 flex items-center justify-between overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

    <div>
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Completed</p>
        <h3 class="text-3xl font-extrabold text-emerald-400 group-hover:text-emerald-200 transition-colors duration-300">
            {{ $completed ?? 5 }}
        </h3>
    </div>

    <div class="p-3 rounded-2xl bg-emerald-500/10 text-emerald-400 transition-all duration-300 ease-in-out group-hover:scale-110 group-hover:bg-emerald-500/20 group-hover:text-emerald-300 group-hover:shadow-[0_0_20px_rgba(16,185,129,0.4)]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
    </div>
</div>

</div>


            <!-- ---------------------------------------------------------------- -->
            <!-- 2. FILTER TOOLBAR & EXPORT                                       -->
            <!-- ---------------------------------------------------------------- -->
            <div class="bg-white/90 dark:bg-slate-900 p-4 sm:p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col lg:flex-row items-center justify-between gap-4">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <div class="relative flex-1 sm:flex-none">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search title, details, agent..." 
                            class="w-full sm:w-72 pl-10 pr-3 py-2.5 bg-slate-50/80 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 dark:text-slate-100"
                        />
                        <span class="absolute left-3.5 top-3 text-slate-400 dark:text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                    </div>

                    <div class="flex items-center gap-2 bg-slate-50/80 dark:bg-slate-800/80 p-1.5 rounded-xl border border-slate-200 dark:border-slate-700">
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="border-none bg-transparent text-xs sm:text-sm dark:text-slate-200 focus:ring-0 py-1 px-2">
                        <span class="text-slate-400 text-xs">to</span>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="border-none bg-transparent text-xs sm:text-sm dark:text-slate-200 focus:ring-0 py-1 px-2">
                    </div>

                    <button type="submit" class="px-4 py-2.5 bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 text-xs font-bold rounded-xl cursor-pointer ocean-btn ocean-btn-slate">Filter</button>
                    @if(request()->hasAny(['search', 'start_date', 'end_date', 'handover']))
                        <a href="{{ route('dashboard') }}" class="px-3.5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl">Reset</a>
                    @endif
                </form>

                <div class="flex items-center gap-2.5 w-full lg:w-auto justify-end">

    <!-- 🔘 MY LOGS / ALL LOGS TOGGLE BUTTON -->
    @if(request('my_logs'))
        <!-- Active State: Showing 'My Logs' -> Click to see 'All Logs' -->
        <a href="{{ route('dashboard', request()->except('my_logs')) }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs font-bold shadow-md cursor-pointer flex items-center gap-1.5 ocean-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            All Logs
        </a>
    @else
        <!-- Default State: Showing 'All Logs' -> Click to filter 'My Logs' -->
        <a href="{{ route('dashboard', array_merge(request()->query(), ['my_logs' => 1])) }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700/80 rounded-xl text-xs font-bold shadow-md cursor-pointer flex items-center gap-1.5 ocean-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            My Logs
        </a>
    @endif

    <!-- LOG ACTIVITY BUTTON -->
    <button @click="openModal = true" type="button" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs font-bold shadow-md cursor-pointer flex items-center gap-1.5 ocean-btn">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Log Activity
    </button>

    <!-- TODAY'S HANDOVER BUTTON -->
    <a href="{{ route('dashboard', ['handover' => 1]) }}" class="px-4 py-2.5 {{ request('handover') ? 'bg-amber-500 text-white' : 'bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400' }} rounded-xl text-xs font-bold shadow-sm ocean-btn ocean-btn-amber">
        Today's Handover
    </a>

    <!-- EXPORT CSV BUTTON -->
    <a href="{{ route('activities.export', request()->query()) }}" class="px-4 py-2.5 bg-emerald-600 text-white rounded-xl text-xs font-bold shadow-md ocean-btn ocean-btn-emerald">
        Export CSV
    </a>

</div>
            </div>

            <!-- ---------------------------------------------------------------- -->
            <!-- 3. MAIN ACTIVITIES TABLE WITH EDIT & DELETE ACTIONS               -->
            <!-- ---------------------------------------------------------------- -->
            <div class="bg-white/90 dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-lg flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Support Activity Logs
                    </h3>
                    <span class="px-3 py-1 bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-300 font-bold text-xs rounded-full border border-indigo-100 dark:border-indigo-900/50">
                        Total Records: {{ $activities->total() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800 text-xs font-extrabold uppercase tracking-wider text-slate-400">
                                <th class="py-4 px-6">ID</th>
                                <th class="py-4 px-6">Activity & Details</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6">Handover Remarks</th>
                                <th class="py-4 px-6">Logged By</th>
                                <th class="py-4 px-6">Timestamp</th>
                                <th class="py-4 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm md:text-base">
                            @forelse($activities as $log)
                                <tr class="hover:bg-indigo-50/40 dark:hover:bg-slate-800/60 transition-colors duration-150 group">
                                    <td class="py-4 px-6 text-slate-400 dark:text-slate-500 font-mono text-xs md:text-sm">#{{ $log->id }}</td>
                                    
                                    <td class="py-4 px-6 max-w-sm">
                                        <div class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                            {{ $log->activity_title }}
                                        </div>
                                        <div class="text-xs md:text-sm text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">
                                            {{ $log->description }}
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 whitespace-nowrap">
                                        @if($log->status === 'Done')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300">
                                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Done
                                            </span>
                                        @elseif($log->status === 'In Progress')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-100 dark:bg-blue-950/70 text-blue-800 dark:text-blue-300">
                                                <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span> In Progress
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300">
                                                <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-4 px-6 max-w-xs text-xs md:text-sm text-slate-600 dark:text-slate-300">
                                        {{ $log->remarks ?? 'N/A' }}
                                    </td>

                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 font-bold text-xs flex items-center justify-center">
                                                {{ strtoupper(substr($log->user->name ?? 'A', 0, 1)) }}
                                            </div>
                                            <span class="text-xs md:text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $log->user->name ?? 'Unknown' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 whitespace-nowrap text-xs md:text-sm text-slate-400 font-medium">
                                        {{ $log->created_at->format('M d, Y') }}
                                        <span class="block text-xs text-slate-400 dark:text-slate-500">{{ $log->created_at->format('h:i A') }}</span>
                                    </td>

                                    <!-- Action Buttons: Edit & Delete -->
                                    <td class="py-4 px-6 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Edit Button -->
                                             <!-- check if current logged in user owns logs or is an admin -->
                                             @if(auth()->id() === $log->user_id || (auth()->user()-> is_admin ?? false))
                                            <button 
                                                type="button"
                                                @click="
                                                    editData = {
                                                        id: '{{ $log->id }}',
                                                        activity_title: '{{ addslashes($log->activity_title) }}',
                                                        description: '{{ addslashes($log->description) }}',
                                                        status: '{{ $log->status }}',
                                                        remarks: '{{ addslashes($log->remarks ?? '') }}'
                                                    }; 
                                                    openEditModal = true;
                                                "
                                                class="p-2 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/50 rounded-lg transition-colors cursor-pointer"
                                                title="Edit Activity"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </button>

                                            <!-- Delete Button -->
                                            <form 
                                                method="POST" 
                                                action="{{ route('activities.destroy', $log->id) }}" 
                                                onsubmit="return confirm('Are you sure you want to delete this log entry?');"
                                                class="inline-block"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="p-2 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/50 rounded-lg transition-colors cursor-pointer"
                                                    title="Delete Activity"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                        @else
                                        <!-- show read only indicator if user didnt log for this intem -->
                                        <span class="text-xs text-slate-500 italic">View Only</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-slate-400">
                                        <p class="font-medium text-slate-500 dark:text-slate-400">No activity logs found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-100 dark:border-slate-800">
                    {{ $activities->links() }}
                </div>
            </div>

        </div>

        <!-- ---------------------------------------------------------------- -->
        <!-- 4. MODAL: LOG NEW ACTIVITY                                       -->
        <!-- ---------------------------------------------------------------- -->
        <div 
            x-show="openModal" 
            style="display: none;"
            class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        >
            <div @click.away="openModal = false" class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 max-w-lg w-full p-6 space-y-5 shadow-2xl">
                <div class="flex justify-between items-center border-b dark:border-slate-800 pb-3">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">New Support Activity Log</h3>
                    <button @click="openModal = false" type="button" class="text-slate-400 text-2xl font-bold cursor-pointer">&times;</button>
                </div>

                <form method="POST" action="{{ route('activities.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Activity Title</label>
                        <input type="text" name="activity_title" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 text-sm" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Description / Actions Taken</label>
                        <textarea name="description" rows="3" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 text-sm"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Status</label>
                            <select name="status" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 text-sm">
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Remarks</label>
                            <input type="text" name="remarks" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 text-sm" />
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 pt-3 border-t dark:border-slate-800">
                        <button type="button" @click="openModal = false" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-xs ocean-btn ocean-btn-rose font-bold">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold ocean-btn ocean-btn-emerald">Save Activity</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ---------------------------------------------------------------- -->
        <!-- 5. MODAL: EDIT EXISTING ACTIVITY                                 -->
        <!-- ---------------------------------------------------------------- -->
        <div 
            x-show="openEditModal" 
            style="display: none;"
            class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        >
            <div @click.away="openEditModal = false" class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 max-w-lg w-full p-6 space-y-5 shadow-2xl">
                <div class="flex justify-between items-center border-b dark:border-slate-800 pb-3">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Activity Log #<span x-text="editData.id"></span></h3>
                    <button @click="openEditModal = false" type="button" class="text-slate-400 text-2xl font-bold cursor-pointer">&times;</button>
                </div>

                <form method="POST" :action="'/activities/' + editData.id" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Activity Title</label>
                        <input type="text" name="activity_title" x-model="editData.activity_title" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 text-sm" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Description / Actions Taken</label>
                        <textarea name="description" rows="3" x-model="editData.description" required class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 text-sm"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Status</label>
                            <select name="status" x-model="editData.status" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 text-sm">
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Remarks</label>
                            <input type="text" name="remarks" x-model="editData.remarks" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 text-sm" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t dark:border-slate-800">
                        <button type="button" @click="openEditModal = false" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-xs font-bold ocean-btn ocean-btn-rose">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold ocean-btn ocean-btn-emerald">Update Activity</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
