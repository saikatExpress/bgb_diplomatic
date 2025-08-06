@extends('setting.app')
@section('title', 'Show Region')

@push('styles')
    <style>
        .show-container {
            max-width: 750px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            position: relative;
            transition: transform 0.3s;
        }

        .show-container:hover {
            transform: translateY(-3px);
        }

        .show-header {
            background: linear-gradient(90deg, #A91D2A, #D72638);
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            margin: -30px -30px 30px -30px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            position: relative;
        }

        .back-btn {
            position: absolute;
            left: 20px;
            top: 20px;
            background: white;
            color: #A91D2A;
            font-weight: bold;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .back-btn:hover {
            background: #FCE4E4;
            color: #D72638;
        }

        .info-card {
            display: flex;
            flex-direction: column;
            gap: 15px;
            font-size: 1rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            background: #f8f9fa;
            padding: 12px 18px;
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .info-label {
            font-weight: 600;
            color: #555;
        }

        .info-value {
            color: #333;
        }

        .btn-edit {
            background: linear-gradient(90deg, #A91D2A, #D72638);
            color: #fff;
            font-weight: bold;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            transition: background 0.3s, transform 0.2s;
            font-size: 1rem;
            display: block;
            width: 100%;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: linear-gradient(90deg, #88111D, #C2182B);
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('content')
    <div class="show-container">
        <a href="{{ route('region.index') }}" class="back-btn">← Back</a>
        <div class="show-header">Region Details</div>

        <div class="info-card">
            <div class="info-item">
                <span class="info-label">Region Name:</span>
                <span class="info-value">{{ filter($region->name) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Region Code:</span>
                <span class="info-value">{{ $region->code }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Country:</span>
                <span class="info-value">{{ filter($region->country) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Latitude:</span>
                <span class="info-value">{{ $region->lat }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Longitude:</span>
                <span class="info-value">{{ $region->lon }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Created At:</span>
                <span
                    class="info-value">{{ ($region->created_at != null) ? $region->created_at->format('d M Y, h:i A') : '' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Last Updated:</span>
                <span
                    class="info-value">{{ ($region->updated_at != null) ? $region->updated_at->format('d M Y, h:i A') : '' }}</span>
            </div>
        </div>

        <a href="{{ route('region.edit', $region->id) }}" class="btn-edit">
            <i class="fa fa-edit me-1"></i> Edit Region
        </a>
    </div>
@endsection