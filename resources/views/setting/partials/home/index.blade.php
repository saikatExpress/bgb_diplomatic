@extends('setting.app')
@section('title', 'Super Panel')

@push('styles')
    <style>
        .dashboard-wrapper {
            width: 90%;
            margin: 20px auto;
        }

        .dashboard-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 30px;
            color: #333;
        }

        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            flex: 1 1 calc(25% - 20px);
            min-width: 220px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            padding: 20px;
            color: #fff;
            transition: transform 0.3s ease;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h5 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 2rem;
            font-weight: bold;
        }

        /* Gradient backgrounds */
        .card-letters {
            background: linear-gradient(45deg, #4e73df, #224abe);
        }

        .card-ref-letters {
            background: linear-gradient(45deg, #1cc88a, #0d6848);
        }

        .card-reply-letters {
            background: linear-gradient(45deg, #f6c23e, #dda20a);
        }

        .card-kill {
            background: linear-gradient(45deg, #e74a3b, #be2617);
        }

        .card-injurious {
            background: linear-gradient(45deg, #36b9cc, #117a8b);
        }

        .card-firing {
            background: linear-gradient(45deg, #858796, #3a3b45);
        }

        .card-battalion {
            background: linear-gradient(45deg, #5a5c69, #23252f);
        }

        .card-sector {
            background: linear-gradient(45deg, #20c997, #0f766e);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .card {
                flex: 1 1 calc(33.333% - 20px);
            }
        }

        @media (max-width: 768px) {
            .card {
                flex: 1 1 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .card {
                flex: 1 1 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-wrapper">
        <h2 class="dashboard-title">📊 Admin Dashboard</h2>
        <div class="dashboard-cards">
            <div class="card card-letters">
                <h5>✉️ Total Letters</h5>
                <h3>{{ $totalLetters ?? 0 }}</h3>
            </div>

            <div class="card card-ref-letters">
                <h5>📄 Total Reference Letters</h5>
                <h3>{{ $totalReferenceLetters ?? 0 }}</h3>
            </div>

            <div class="card card-reply-letters">
                <h5>📬 Total Reply Letters</h5>
                <h3>{{ $totalReplyLetters ?? 0 }}</h3>
            </div>

            <div class="card card-kill">
                <h5>☠️ Total Kill</h5>
                <h3>{{ $totalKill ?? 0 }}</h3>
            </div>

            <div class="card card-injurious">
                <h5>🤕 Total Injurious</h5>
                <h3>{{ $totalInjurious ?? 0 }}</h3>
            </div>

            <div class="card card-firing">
                <h5>🔫 Total Firing</h5>
                <h3>{{ $totalFiring ?? 0 }}</h3>
            </div>

            <div class="card card-battalion">
                <h5>🏰 Total Battalion</h5>
                <h3>{{ $totalBattalion ?? 0 }}</h3>
            </div>

            <div class="card card-sector">
                <h5>📍 Total Sector</h5>
                <h3>{{ $totalSector ?? 0 }}</h3>
            </div>
        </div>
    </div>
@endsection
