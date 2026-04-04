@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Site Settings & About Myself</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="max-w-5xl mx-auto space-y-12">
            <!-- General & Bio Settings -->
            <div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="col-span-2">
                            <h2 class="text-xl font-bold mb-4 text-gray-700 border-b pb-2">General Settings</h2>
                        </div>
                        <div>
                            <label for="site_name" class="block text-gray-700 text-sm font-bold mb-2">Site Name:</label>
                            <input type="text" name="site_name" id="site_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('site_name', $settings['site_name']?->value ?? '') }}">
                        </div>

                        <div>
                            <label for="contact_email" class="block text-gray-700 text-sm font-bold mb-2">Contact Email:</label>
                            <input type="email" name="contact_email" id="contact_email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('contact_email', $settings['contact_email']?->value ?? '') }}">
                        </div>

                        <div>
                            <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                            <input type="text" name="phone_number" id="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('phone_number', $settings['phone_number']?->value ?? '') }}">
                        </div>
                        
                        <div>
                            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
                            <textarea name="address" id="address" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('address', $settings['address']?->value ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4 text-gray-700 border-b pb-2">About Myself - Bio</h2>
                        <textarea name="about_myself_content" id="about_myself_content" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('about_myself_content', $settings['about_myself_content']?->value ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-8 rounded focus:outline-none focus:shadow-outline transition duration-200">
                            Save General Settings
                        </button>
                    </div>
                </form>
            </div>

            <!-- Educational Background Section -->
            <div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
                <h2 class="text-xl font-bold mb-6 text-gray-700 border-b pb-2">Educational Background</h2>
                
                <form action="{{ route('admin.settings.education.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 bg-gray-50 p-4 rounded-lg shadow-inner">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Year Range</label>
                        <input type="text" name="year" class="w-full border-gray-300 rounded text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. 2018 - 2022" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Degree/Course</label>
                        <input type="text" name="degree" class="w-full border-gray-300 rounded text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. B.Sc in Computer Science" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Institution</label>
                        <input type="text" name="institution" class="w-full border-gray-300 rounded text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. Dhaka University" required>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 rounded text-sm shadow transition duration-200">
                            <i class="fas fa-plus mr-1"></i> Add Entry
                        </button>
                    </div>
                </form>

                <div class="space-y-3">
                    @foreach($education as $index => $item)
                        <div class="flex justify-between items-center p-4 border border-gray-100 rounded-xl hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center gap-4">
                                <span class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-sm">
                                    {{ $index + 1 }}
                                </span>
                                <div>
                                    <span class="text-xs font-bold text-blue-600 uppercase">{{ $item->year }}</span>
                                    <h4 class="font-bold text-gray-800">{{ $item->degree }}</h4>
                                    <p class="text-sm text-gray-500">{{ $item->institution }}</p>
                                </div>
                            </div>
                            <form action="{{ route('admin.settings.education.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this educational record?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-2 rounded-full hover:bg-red-50">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Languages Section -->
                <div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
                    <h2 class="text-xl font-bold mb-6 text-gray-700 border-b pb-2">Languages</h2>
                    
                    <form action="{{ route('admin.settings.languages.store') }}" method="POST" class="space-y-4 mb-8 bg-gray-50 p-4 rounded-lg shadow-inner">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Language</label>
                                <input type="text" name="name" class="w-full border-gray-300 rounded text-sm" placeholder="e.g. English" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Level</label>
                                <input type="text" name="level" class="w-full border-gray-300 rounded text-sm" placeholder="e.g. Fluent" required>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 rounded text-sm shadow transition duration-200">
                            <i class="fas fa-plus mr-1"></i> Add Language
                        </button>
                    </form>

                    <div class="space-y-2">
                        @foreach($languages as $index => $item)
                            <div class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <span class="text-primary font-bold text-sm">{{ $index + 1 }}.</span>
                                    <span class="font-bold text-gray-800">{{ $item->name }}: <span class="font-normal text-gray-500">{{ $item->level }}</span></span>
                                </div>
                                <form action="{{ route('admin.settings.languages.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600"><i class="fas fa-times-circle"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- References Section -->
                <div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
                    <h2 class="text-xl font-bold mb-6 text-gray-700 border-b pb-2">References</h2>
                    
                    <form action="{{ route('admin.settings.references.store') }}" method="POST" class="space-y-4 mb-8 bg-gray-50 p-4 rounded-lg shadow-inner">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Full Name</label>
                            <input type="text" name="name" class="w-full border-gray-300 rounded text-sm" placeholder="Reference Name" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Position</label>
                                <input type="text" name="position" class="w-full border-gray-300 rounded text-sm" placeholder="Job Title" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Contact</label>
                                <input type="text" name="contact" class="w-full border-gray-300 rounded text-sm" placeholder="Email or Phone" required>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 rounded text-sm shadow transition duration-200">
                            <i class="fas fa-plus mr-1"></i> Add Reference
                        </button>
                    </form>

                    <div class="space-y-3">
                        @foreach($references as $index => $item)
                            <div class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                <div class="flex gap-3">
                                    <span class="text-primary font-bold text-sm">{{ $index + 1 }}.</span>
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-sm">{{ $item->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ $item->position }} | {{ $item->contact }}</p>
                                    </div>
                                </div>
                                <form action="{{ route('admin.settings.references.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600"><i class="fas fa-trash-alt text-xs"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Skills Section -->
                <div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
                    <h2 class="text-xl font-bold mb-6 text-gray-700 border-b pb-2">Skills</h2>
                    
                    <form action="{{ route('admin.settings.skills.store') }}" method="POST" class="space-y-4 mb-8 bg-gray-50 p-4 rounded-lg shadow-inner">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Skill Name</label>
                                <input type="text" name="name" class="w-full border-gray-300 rounded text-sm" placeholder="e.g. Photography" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Percentage (%)</label>
                                <input type="number" name="percentage" class="w-full border-gray-300 rounded text-sm" placeholder="100" min="0" max="100" value="100" required>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 rounded text-sm shadow transition duration-200">
                            <i class="fas fa-plus mr-1"></i> Add Skill
                        </button>
                    </form>

                    <div class="space-y-2">
                        @foreach($skills as $index => $item)
                            <div class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <span class="text-primary font-bold text-sm">{{ $index + 1 }}.</span>
                                    <span class="font-bold text-gray-800">{{ $item->name }} ({{ $item->percentage }}%)</span>
                                </div>
                                <form action="{{ route('admin.settings.skills.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600"><i class="fas fa-times-circle"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Software Expertise Section -->
                <div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
                    <h2 class="text-xl font-bold mb-6 text-gray-700 border-b pb-2">Software Expertise</h2>
                    
                    <form action="{{ route('admin.settings.softwares.store') }}" method="POST" class="space-y-4 mb-8 bg-gray-50 p-4 rounded-lg shadow-inner">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Software Name</label>
                                <input type="text" name="name" class="w-full border-gray-300 rounded text-sm" placeholder="e.g. Adobe Photoshop" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Icon (FontAwesome Class)</label>
                                <input type="text" name="icon" class="w-full border-gray-300 rounded text-sm" placeholder="e.g. fab fa-adobe">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 rounded text-sm shadow transition duration-200">
                            <i class="fas fa-plus mr-1"></i> Add Software
                        </button>
                    </form>

                    <div class="space-y-2">
                        @foreach($softwares as $index => $item)
                            <div class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <span class="text-primary font-bold text-sm">{{ $index + 1 }}.</span>
                                    <span class="font-bold text-gray-800">
                                        @if($item->icon)
                                            <i class="{{ $item->icon }} mr-2"></i>
                                        @endif
                                        {{ $item->name }}
                                    </span>
                                </div>
                                <form action="{{ route('admin.settings.softwares.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600"><i class="fas fa-times-circle"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection