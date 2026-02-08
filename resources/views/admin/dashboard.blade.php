@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>
        /* Ensure the modal is centered and has a backdrop */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1050; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
        }
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: 10% auto; /* 10% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 600px;
            border-radius: 0.5rem;
        }
        .modal-header {
            padding: 1rem 1rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
        }

        .modal-footer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            padding: 0.75rem;
            border-top: 1px solid #dee2e6;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .img-container img {
            max-width: 100%;
        }
    </style>
@endpush

@section('content')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
            <!-- Dashboard Cards/Widgets can go here -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Galleries</h3>
                <p class="text-4xl font-bold text-blue-600">5</p>
                {{-- Optional: Add an icon here --}}
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Photos</h3>
                <p class="text-4xl font-bold text-blue-600">25</p>
                {{-- Optional: Add an icon here --}}
            </div>
        </div>
    
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Card for Profile Picture Management -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Manage Profile Picture</h3>
                <div class="flex flex-col items-center">
                    <img src="{{ Auth::user()->profile_picture_url ?? asset('images/default_profile.png') }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover mb-4">
                    <form action="{{ route('admin.profile.updateProfilePicture') }}" method="POST" enctype="multipart/form-data" id="profilePictureForm" class="w-full text-center">
                        @csrf
                        <input type="file" name="profile_picture" id="profile_picture_input" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100 mb-4" accept="image/*"/>
                        <input type="hidden" name="cropped_image_data" id="croppedProfileImageData">
                        <button type="button" id="uploadProfilePictureBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Upload Profile Picture</button>
                    </form>
                </div>
            </div>
    
            <!-- Card for "About Me" Section Picture Management -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Manage "About Me" Picture</h3>
                <div class="flex flex-col items-center">
                    {{-- Assuming 'about_me_picture_url' is stored in a Setting model or similar --}}
                    <img src="{{ \App\Models\Setting::get('about_me_picture_url', asset('images/default_about_me.png')) }}" alt="About Me Picture" class="w-32 h-32 object-cover mb-4">
                    <form action="{{ route('admin.settings.updateAboutMePicture') }}" method="POST" enctype="multipart/form-data" id="aboutMePictureForm" class="w-full text-center">
                        @csrf
                        <input type="file" name="about_me_picture" id="about_me_picture_input" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100 mb-4" accept="image/*"/>
                        <input type="hidden" name="cropped_image_data" id="croppedAboutMeImageData">
                        <button type="button" id="uploadAboutMePictureBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Upload "About Me" Picture</button>
                    </form>
                </div>
            </div>
        </div>

    <!-- Modal for Cropping -->
    <div id="cropModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="imageToCrop" src="" alt="Image to crop">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md" data-dismiss="modal">Cancel</button>
                <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md" id="cropAndUpload">Crop & Upload</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('cropModal');
    const image = document.getElementById('imageToCrop');
    const cropAndUploadBtn = document.getElementById('cropAndUpload');
    const closeModalBtns = document.querySelectorAll('[data-dismiss="modal"]');

    let cropper;
    let activeForm;
    let hiddenInput;

    function setupCropper(file, aspectRatio) {
        const reader = new FileReader();
        reader.onload = function (e) {
            image.src = e.target.result;
            modal.style.display = 'block';
            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(image, {
                aspectRatio: aspectRatio,
                viewMode: 1,
                // Other options here
            });
        };
        reader.readAsDataURL(file);
    }

    document.getElementById('uploadProfilePictureBtn').addEventListener('click', function() {
        document.getElementById('profile_picture_input').click();
    });

    document.getElementById('profile_picture_input').addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            activeForm = document.getElementById('profilePictureForm');
            hiddenInput = document.getElementById('croppedProfileImageData');
            setupCropper(files[0], 1 / 1); // 1:1 Aspect Ratio for profile picture
        }
    });

    document.getElementById('uploadAboutMePictureBtn').addEventListener('click', function() {
        document.getElementById('about_me_picture_input').click();
    });

    document.getElementById('about_me_picture_input').addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            activeForm = document.getElementById('aboutMePictureForm');
            hiddenInput = document.getElementById('croppedAboutMeImageData');
            setupCropper(files[0], 16 / 9); // 16:9 Aspect Ratio for about me
        }
    });

    cropAndUploadBtn.addEventListener('click', function () {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                // Example: Resize the output image
                width: 1024,
                // height is auto-calculated based on aspect ratio
                imageSmoothingQuality: 'high',
            });
            // Get the data URL and set it to the hidden input
            hiddenInput.value = canvas.toDataURL('image/jpeg', 0.8); // Use JPEG with quality 80%
            activeForm.submit();
        }
    });

    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            modal.style.display = 'none';
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        });
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }
    }
});
</script>
@endpush