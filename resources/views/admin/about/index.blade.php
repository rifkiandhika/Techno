@extends('admin.layouts.app')

@section('title', 'About Us - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="ti ti-info-circle me-2"></i> About Us Settings
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Brand History / Story</label>
                <textarea name="brand_history" class="form-control" rows="6">{{ old('brand_history', $aboutUs->brand_history) }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vision</label>
                    <textarea name="vision" class="form-control" rows="3">{{ old('vision', $aboutUs->vision) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mission</label>
                    <textarea name="mission" class="form-control" rows="3">{{ old('mission', $aboutUs->mission) }}</textarea>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Founder Story</label>
                <textarea name="founder_story" class="form-control" rows="5">{{ old('founder_story', $aboutUs->founder_story) }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    @if($aboutUs->founder_photo)
                    <div class="mb-3">
                        <label class="form-label">Current Founder Photo</label>
                        <div>
                            <img src="{{ asset($aboutUs->founder_photo) }}" class="rounded" width="150">
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Change Founder Photo</label>
                        <input type="file" name="founder_photo" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
            
            <hr>
            
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy me-1"></i> Save Changes
            </button>
        </form>
    </div>
</div>
</div>
@endsection