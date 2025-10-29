<div>
    <div class="dashboard-stats-component" style="margin-bottom: 2rem;">
        <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
            <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="margin-bottom: 0.5rem; font-size: 0.9rem; opacity: 0.9;">📅 Total Events</h4>
                <p class="stat-value" style="font-size: 2.5rem; font-weight: 700; margin: 0;">{{ $stats['total_events'] }}</p>
            </div>
            
            <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="margin-bottom: 0.5rem; font-size: 0.9rem; opacity: 0.9;">✅ Active Events</h4>
                <p class="stat-value" style="font-size: 2.5rem; font-weight: 700; margin: 0;">{{ $stats['active_events'] }}</p>
            </div>
            
            <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="margin-bottom: 0.5rem; font-size: 0.9rem; opacity: 0.9;">👥 Total Users</h4>
                <p class="stat-value" style="font-size: 2.5rem; font-weight: 700; margin: 0;">{{ $stats['total_users'] }}</p>
            </div>

            <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="margin-bottom: 0.5rem; font-size: 0.9rem; opacity: 0.9;">📝 Registrations</h4>
                <p class="stat-value" style="font-size: 2.5rem; font-weight: 700; margin: 0;">{{ $stats['total_registrations'] }}</p>
            </div>

            <div class="stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="margin-bottom: 0.5rem; font-size: 0.9rem; opacity: 0.9;">🎯 Upcoming</h4>
                <p class="stat-value" style="font-size: 2.5rem; font-weight: 700; margin: 0;">{{ $stats['upcoming_events'] }}</p>
            </div>
        </div>
    </div>
</div>
