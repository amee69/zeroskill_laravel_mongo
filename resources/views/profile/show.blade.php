<x-guest-layout>
    <div class="pt-32">
        <h1 class="text-3xl font-bold mb-6 text-center text-white z-50">Profile</h1>
    </div>
    <div class="max-w-3xl mx-auto my-20 p-8 bg-black/50 border-2 border-white backdrop-blur-md rounded-3xl shadow-lg">
        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-black/70">
                    <th class="w-1/3 px-6 py-3 text-left">Field</th>
                    <th class="w-2/3 px-6 py-3 text-left">Information</th>
                    <th class="w-1/4 px-6 py-3 text-center">Edit Options</th>
                </tr>
            </thead>
            <tbody>
                <!-- Name -->
                <tr class="border-b border-white/30">
                    <td class="px-6 py-4 font-semibold">Name:</td>
                    <td class="px-6 py-4 break-words">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-center"></td>
                </tr>

                <!-- Email Address -->
                <tr class="border-b border-white/30">
                    <td class="px-6 py-4 font-semibold">Email Address:</td>
                    <td class="px-6 py-4 break-words">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-center"></td>
                </tr>

                <!-- Phone Number -->
                <tr class="border-b border-white/30">
                    <td class="px-6 py-4 font-semibold">Phone Number:</td>
                    <td class="px-6 py-4 break-words">{{ $user->number }}</td>
                    <td class="px-6 py-4 text-center">
                        <button id="editnumbermodaltriggerbutton" class="bg-red-600 text-white text-sm font-medium px-5 py-2 rounded-3xl w-32 text-center">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- Address -->
                <tr class="border-b border-white/30">
                    <td class="px-6 py-4 font-semibold">Address:</td>
                    <td class="px-6 py-4 break-words">{{ $user->address }}</td>
                    <td class="px-6 py-4 text-center"></td>
                </tr>

                <!-- Membership Status -->
                <tr class="border-b border-white/30">
                    <td class="px-6 py-4 font-semibold">Membership Status:</td>
                    <td class="px-6 py-4 break-words">
                        @if ($membershipData)
                            <span class="text-2xl text-red-600">
                                {{ $tierName ?? 'Unknown Tier' }} Membership
                            </span><br>
                            <span class="text-lg">Ends On: {{ \Carbon\Carbon::parse($membershipData['end_date'])->format('d-m-Y') }}</span>
                            
                            @if (\Carbon\Carbon::parse($membershipData['end_date'])->isFuture())
                                <span class="text-green-600 text-lg block">Active</span>
                                <div class="mt-4">
                                    <button id="cancelmembershipmodaltriggerbutton" class="bg-red-600 text-white text-sm font-medium px-5 py-2 rounded-3xl w-32 text-center">
                                        Cancel Membership
                                    </button>
                                </div>
                                
                            @else
                                <span class="text-red-600 text-lg block">Expired</span>
                                <a href="{{ route('membership') }}" class="bg-black/70 text-white text-sm font-medium px-5 py-2 rounded-3xl border-2 border-white hover:bg-red-700 transition-all duration-300 inline-block w-32 text-center mt-4">
                                    Renew Membership
                                </a>
                            @endif

                        @else
                            <a href="{{ route('membership') }}" class="bg-black/70 text-white text-sm font-medium px-5 py-2 rounded-3xl border-2 border-white hover:bg-red-700 transition-all duration-300 inline-block w-32 text-center">
                                Explore Memberships
                            </a>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center"></td>
                </tr>

                <!-- Password Update Section -->
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <tr class="border-b border-white/30">
                        <td class="px-6 py-4 font-semibold">Password:</td>
                        <td class="px-6 py-4 break-words text-red-600">********</td>
                        <td class="px-6 py-4 text-center">
                            <button id="update-password-button" class="bg-red-600 text-white text-sm font-medium px-5 py-2 rounded-3xl w-32 text-center">
                                Update Password
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        

        <!-- Cancel Membership Modal -->
        <div id="cancel-membership-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-black/50 backdrop-blur-md border p-8 rounded-3xl shadow-lg max-w-md w-full">
                <h2 class="text-2xl font-bold mb-4 text-red-600">Cancel Membership</h2>
                <p class="text-white mb-6">
                    Are you sure you want to cancel your membership? This action is permanent, cannot be undone, and no refunds will be given.
                </p>
                <div class="flex justify-end gap-4">
                    <button id="cancel-modal-close" class="bg-gray-500 text-white px-4 py-2 rounded-3xl">
                        Cancel
                    </button>
                    <button class="bg-red-600 text-white px-4 py-2 rounded-3xl">
                        Confirm
                    </button>
                </div>
            </div>
        </div>



        <!-- Password Update Modal -->
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div id="password-update-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-black/50 backdrop-blur-md border p-8 rounded-3xl shadow-lg max-w-md w-full">
                    <h2 class="text-2xl font-bold mb-4 text-red-600">Update Password</h2>
                    <div class="mb-4">
                        @livewire('profile.update-password-form')
                    </div>
                    <button id="close-password-modal" class="bg-gray-500 text-white px-4 py-2 rounded-3xl w-full mt-4">
                        Close
                    </button>
                </div>
            </div>
        @endif
    </div>


    
    <script>
        // Cancel Membership Modal
        const cancelMembershipModalTrigger = document.getElementById('cancelmembershipmodaltriggerbutton');
        const cancelMembershipModal = document.getElementById('cancel-membership-modal');
        const cancelMembershipClose = document.getElementById('cancel-modal-close');

        if (cancelMembershipModalTrigger && cancelMembershipModal) {
            cancelMembershipModalTrigger.addEventListener('click', () => {
                cancelMembershipModal.classList.remove('hidden');
            });

            cancelMembershipClose.addEventListener('click', () => {
                cancelMembershipModal.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === cancelMembershipModal) {
                    cancelMembershipModal.classList.add('hidden');
                }
            });
        }

        // Password Update Modal
        const updatePasswordButton = document.getElementById('update-password-button');
        const passwordUpdateModal = document.getElementById('password-update-modal');
        const closePasswordModal = document.getElementById('close-password-modal');

        if (updatePasswordButton && passwordUpdateModal && closePasswordModal) {
            updatePasswordButton.addEventListener('click', () => {
                passwordUpdateModal.classList.remove('hidden');
            });

            closePasswordModal.addEventListener('click', () => {
                passwordUpdateModal.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === passwordUpdateModal) {
                    passwordUpdateModal.classList.add('hidden');
                }
            });
        }
    </script>
</x-guest-layout>
