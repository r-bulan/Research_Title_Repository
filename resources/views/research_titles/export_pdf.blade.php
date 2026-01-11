<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS Research Titles Export</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            color: #1e40af;
            font-size: 24px;
        }
        
        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        
        .info-bar {
            background-color: #f3f4f6;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 11px;
            border-left: 4px solid #1e40af;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        thead {
            background-color: #1e40af;
            color: white;
        }
        
        th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            border: 1px solid #1e40af;
        }
        
        td {
            padding: 10px 8px;
            font-size: 11px;
            border: 1px solid #e5e7eb;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        tbody tr:hover {
            background-color: #f3f4f6;
        }
        
        .category-badge {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            display: inline-block;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 10px;
            color: #666;
            text-align: center;
        }
        
        .summary {
            background-color: #f0fdf4;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 4px solid #16a34a;
            font-size: 11px;
        }
        
        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: #999;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>📚 CCS Research Title Repository</h1>
        <p>College of Computer Studies Research Titles Export</p>
        <p>Generated on: {{ $exportDate->format('F d, Y \a\t h:i A') }}</p>
    </div>

    <!-- Info Bar -->
    <div class="info-bar">
        <strong>📊 Export Information:</strong> This document contains {{ $researchTitles->count() }} research title(s) out of {{ $totalCount }} total active records in the system.
    </div>

    @if ($researchTitles->count() > 0)
        <!-- Summary -->
        <div class="summary">
            <strong>✓ Summary:</strong> Total Exported Records: <strong>{{ $researchTitles->count() }}</strong> | Categories Included: <strong>{{ $researchTitles->pluck('category.name')->unique()->count() }}</strong>
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th style="width: 15%;">Author</th>
                    <th style="width: 30%;">Research Title</th>
                    <th style="width: 15%;">Category</th>
                    <th style="width: 20%;">Email</th>
                    <th style="width: 10%;">Created</th>
                    <th style="width: 10%;">Photo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($researchTitles as $title)
                    <tr>
                        <td><strong>{{ $title->author_name }}</strong></td>
                        <td>{{ $title->title }}</td>
                        <td>
                            <span class="category-badge">{{ $title->category->name }}</span>
                        </td>
                        <td>{{ $title->email }}</td>
                        <td>{{ $title->created_at->format('M d, Y') }}</td>
                        <td>{{ $title->photo ? '✓ Yes' : '✗ No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>📭 No research titles found matching the current filters.</p>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>
            <strong>CCS Research Title Repository</strong> | 
            Document Generated: {{ $exportDate->format('Y-m-d H:i:s') }} | 
            Filename: ccs_research_titles_{{ $exportDate->format('YmdHis') }}.pdf
        </p>
        <p style="margin-top: 10px; font-size: 9px; color: #999;">
            This is an automated export from the CCS Research Title Repository system. 
            For official records, please contact the College of Computer Studies Department.
        </p>
    </div>
</body>
</html>
