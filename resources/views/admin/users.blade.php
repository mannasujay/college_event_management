<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 2rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #10b981;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .users-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .card-header h2 {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table thead {
            background: #f9fafb;
        }

        .users-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #e5e7eb;
        }

        .users-table td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            color: #333;
        }

        .users-table tbody tr:hover {
            background: #f9fafb;
        }

        .role-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .role-student {
            background: #dbeafe;
            color: #1e40af;
        }

        .role-organizer {
            background: #fef3c7;
            color: #92400e;
        }

        .role-admin {
            background: #fee2e2;
            color: #991b1b;
        }

        .role-select {
            padding: 0.5rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: 'Figtree', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
        }

        .role-select:focus {
            outline: none;
            border-color: #667eea;
        }

        .change-role-btn {
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-left: 0.5rem;
        }

        .change-role-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .change-role-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .user-email {
            color: #666;
            font-size: 0.9rem;
        }

        .user-name {
            font-weight: 600;
            color: #333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
        }

        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .no-users {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .no-users-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            font-size: 2.5rem;
        }

        .stat-info h3 {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 0.3rem;
        }

        .stat-info p {
            color: #666;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .card-body {
                padding: 1rem;
                overflow-x: auto;
            }

            .users-table {
                min-width: 600px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👥 User Management</h1>
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                ← Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-info">
                    <h3>{{ $users->total() }}</h3>
                    <p>Total Users</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👨‍🎓</div>
                <div class="stat-info">
                    <h3>{{ \App\Models\User::where('role', 'student')->count() }}</h3>
                    <p>Students</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-info">
                    <h3>{{ \App\Models\User::where('role', 'organizer')->count() }}</h3>
                    <p>Organizers</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👤</div>
                <div class="stat-info">
                    <h3>{{ \App\Models\User::where('role', 'admin')->count() }}</h3>
                    <p>Admins</p>
                </div>
            </div>
        </div>

        <div class="users-card">
            <div class="card-header">
                <h2>📝 All Users</h2>
            </div>
            <div class="card-body">
                @if($users->count() > 0)
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Current Role</th>
                                <th>Joined</th>
                                <th>Change Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-email">{{ $user->email }}</div>
                                    </td>
                                    <td>
                                        <span class="role-badge role-{{ $user->role }}">
                                            @if($user->role === 'student')
                                                👨‍🎓 Student
                                            @elseif($user->role === 'organizer')
                                                📋 Organizer
                                            @else
                                                👤 Admin
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.change-role', $user) }}" method="POST" style="display: inline-flex; align-items: center;">
                                            @csrf
                                            <select name="role" class="role-select" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                                <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                                <option value="organizer" {{ $user->role === 'organizer' ? 'selected' : '' }}>Organizer</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            <button 
                                                type="submit" 
                                                class="change-role-btn"
                                                {{ $user->id === auth()->id() ? 'disabled' : '' }}
                                                onclick="return confirm('Are you sure you want to change this user\'s role?')"
                                            >
                                                Update
                                            </button>
                                        </form>
                                        @if($user->id === auth()->id())
                                            <small style="color: #999; display: block; margin-top: 0.5rem;">Cannot change your own role</small>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($users->hasPages())
                        <div class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($users->onFirstPage())
                                <span style="opacity: 0.5;">← Previous</span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}">← Previous</a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                @if ($page == $users->currentPage())
                                    <span class="active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}">Next →</a>
                            @else
                                <span style="opacity: 0.5;">Next →</span>
                            @endif
                        </div>
                    @endif
                @else
                    <div class="no-users">
                        <div class="no-users-icon">👥</div>
                        <h3>No users found</h3>
                        <p>There are no users in the system yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
