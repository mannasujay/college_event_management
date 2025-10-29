<div>
    <div class="participant-table-component" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        
        <!-- Search and Filter -->
        <div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px;">
                <input 
                    type="text" 
                    wire:model.live="search" 
                    placeholder="🔍 Search by name or email..."
                    style="width: 100%; padding: 0.8rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;"
                    onfocus="this.style.borderColor='#667eea'"
                    onblur="this.style.borderColor='#e0e0e0'"
                >
            </div>
            <div style="flex: 1; min-width: 250px;">
                <select 
                    wire:model.live="eventFilter"
                    style="width: 100%; padding: 0.8rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; transition: all 0.3s; cursor: pointer;"
                    onfocus="this.style.borderColor='#667eea'"
                    onblur="this.style.borderColor='#e0e0e0'"
                >
                    <option value="">📅 All Events</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if($registrations->count() > 0)
            <!-- Table -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb;">
                            <th style="padding: 1rem; text-align: left; color: #666; font-weight: 600;">Participant</th>
                            <th style="padding: 1rem; text-align: left; color: #666; font-weight: 600;">Email</th>
                            <th style="padding: 1rem; text-align: left; color: #666; font-weight: 600;">Event</th>
                            <th style="padding: 1rem; text-align: left; color: #666; font-weight: 600;">Registered</th>
                            <th style="padding: 1rem; text-align: left; color: #666; font-weight: 600;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                            <tr style="border-bottom: 1px solid #e5e7eb; transition: background 0.3s;" 
                                onmouseover="this.style.background='#f9fafb'" 
                                onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                            {{ strtoupper(substr($registration->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong style="color: #333;">{{ $registration->user->name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem; color: #666;">
                                    {{ $registration->user->email }}
                                </td>
                                <td style="padding: 1rem; color: #333;">
                                    {{ $registration->event->title }}
                                </td>
                                <td style="padding: 1rem; color: #666;">
                                    {{ $registration->created_at->format('M d, Y') }}
                                    <br>
                                    <small style="color: #999;">{{ $registration->created_at->diffForHumans() }}</small>
                                </td>
                                <td style="padding: 1rem;">
                                    <span style="padding: 0.4rem 0.8rem; border-radius: 15px; font-size: 0.85rem; font-weight: 600;
                                        @if($registration->status === 'confirmed') background: #d1fae5; color: #065f46;
                                        @elseif($registration->status === 'pending') background: #fef3c7; color: #92400e;
                                        @else background: #fee2e2; color: #991b1b; @endif">
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($registrations->hasPages())
                <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                    @if ($registrations->onFirstPage())
                        <span style="opacity: 0.5; padding: 0.5rem 1rem;">← Previous</span>
                    @else
                        <button wire:click="previousPage" style="padding: 0.5rem 1rem; background: none; border: 1px solid #e5e7eb; border-radius: 8px; color: #667eea; cursor: pointer; transition: all 0.3s;">← Previous</button>
                    @endif

                    <span style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 8px;">
                        Page {{ $registrations->currentPage() }} of {{ $registrations->lastPage() }}
                    </span>

                    @if ($registrations->hasMorePages())
                        <button wire:click="nextPage" style="padding: 0.5rem 1rem; background: none; border: 1px solid #e5e7eb; border-radius: 8px; color: #667eea; cursor: pointer; transition: all 0.3s;">Next →</button>
                    @else
                        <span style="opacity: 0.5; padding: 0.5rem 1rem;">Next →</span>
                    @endif
                </div>
            @endif

            <!-- Summary -->
            <div style="margin-top: 2rem; padding: 1rem; background: #f9fafb; border-radius: 10px; text-align: center;">
                <strong style="color: #333;">Total Registrations: {{ $registrations->total() }}</strong>
            </div>
        @else
            <div style="text-align: center; padding: 3rem; color: #666;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">👥</div>
                <h3 style="color: #333; margin-bottom: 0.5rem;">No participants found</h3>
                <p>No one has registered for events yet, or your search didn't match any results.</p>
            </div>
        @endif
    </div>
</div>
