<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Research Titles Export</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #1e40af;
        }

        .header h1 {
            color: #1e40af;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
            margin: 3px 0;
        }

        .info-bar {
            background-color: #f3f4f6;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 4px solid #1e40af;
            font-size: 11px;
        }

        .summary {
            background-color: #f0fdf4;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 4px solid #16a34a;
            font-size: 11px;
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

        .category-badge {
            display: inline-block;
            background-color: #dbeafe;
            color: #1e40af;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: #999;
            font-size: 14px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 10px;
            color: #666;
            text-align: center;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1> Research Title Repository</h1>
        <p> Research Titles Export</p>
        <p>Generated: {{ $exportDate->format('F d, Y \a\t h:i A') }}</p>
    </div>

    <!-- Info Bar -->
    <div class="info-bar">
        <strong>Export Summary:</strong> {{ $researchTitles->count() }} research title(s) exported out of {{ $totalCount }} total active records.
    </div>

    @if ($researchTitles->count() > 0)
        <!-- Summary Stats -->
        <div class="summary">
            <strong>Report Details:</strong> 
            Total Records: <strong>{{ $researchTitles->count() }}</strong> | 
            Categories: <strong>{{ $researchTitles->pluck('category.name')->unique()->count() }}</strong> | 
            Generated: <strong>{{ $exportDate->format('Y-m-d H:i:s') }}</strong>
        </div>

        <!-- Data Table -->
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
                        <td><span class="category-badge">{{ $title->category->name }}</span></td>
                        <td>{{ $title->email }}</td>
                        <td>{{ $title->created_at->format('M d, Y') }}</td>
                        <td>{{ $title->photo ? ' Yes' : ' No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p> No research titles found matching the current filters.</p>
            <p style="margin-top: 10px; font-size: 12px;">Try adjusting your search criteria and try again.</p>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p><strong> Research Title Repository</strong></p>
        <p>File: research_titles_{{ $exportDate->format('YmdHis') }}.pdf</p>
        <p style="margin-top: 10px; font-size: 9px; color: #999;">
            This document was automatically generated by the Research Title Repository system. 
            For official records, please contact the Management.
        </p>
    </div>
</body>
</html>
