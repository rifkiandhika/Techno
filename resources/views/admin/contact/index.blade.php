@extends('admin.layouts.app')

@section('title', 'Contact Settings - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="ti ti-address-book me-2"></i> Contact Information
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.contact.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">WhatsApp Number</label>
                    <div class="input-group">
                        <span class="input-group-text">+62</span>
                        <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $contact->whatsapp) }}" placeholder="81234567890">
                    </div>
                    <small class="text-muted">Enter without +62 prefix</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}" placeholder="info@equality.com">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Instagram Username</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $contact->instagram) }}">
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">TikTok Username</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" name="tiktok" class="form-control" value="{{ old('tiktok', $contact->tiktok) }}">
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Facebook Username</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $contact->facebook) }}">
                    </div>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="3">{{ old('address', $contact->address) }}</textarea>
                </div>
            </div>
            
            <hr>
            
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy me-1"></i> Save Contact Info
            </button>
        </form>
    </div>
</div>
</div>
@endsection