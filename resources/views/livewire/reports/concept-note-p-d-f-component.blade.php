<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concept Note Report</title>
    <style>
        body { font-family: 'Times New Roman', serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <main>
        <div style="text-align: center;">
            <img src="{{ public_path('assets/images/smzlogo.jpg') }}" style="width:30%;">
            <h3 style="font-family: 'Times New Roman', serif;">DOCUMENT TYPE: 	<span style="font-style: italic;">PROJECT CONCEPT NOTE DOCUMENT</span></h3>
            <h3 style="font-family: 'Times New Roman', serif;">DRAFT DATE: 		<span style="font-style: italic;">{{ $conceptNote->updated_at->format('d-m-Y H:i:s') }}</span></h3>
        </div>
        <h2>1. General Details</h2>
        @if($conceptNote)
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Project Class</th>
                    <td>{{ $conceptNote->class }}</td>
                </tr>
                <tr>
                    <th>Project Name</th>
                    <td>{{ $conceptNote->projectname }}</td>
                </tr>
                <tr>
                    <th>Project Code</th>
                    <td>{{ $conceptNote->project_code }}</td>
                </tr>
                <tr>
                    <th>Total Cost (TZS)</th>
                    <td>{{ number_format($total_project_cost, 2) }}/= TZS</td>
                </tr>
                <tr>
                    <th>Time Frame</th>
                    <td>
                        {{ date('d-m-Y', strtotime($conceptNote->startdate)) }} - {{ date('d-m-Y', strtotime($conceptNote->enddate)) }}

                    </td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>
                        <ul>

                            @foreach ($projectLocations as $location)
                                <li>{{ $location->location_name }} - {{ $location->location_level }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Main Sector</th>
                    <td>{{ $sector_name }}</td>
                </tr>
                <tr>
                    <th>Outcome</th>
                    <td>{{ $outcome }}</td>
                </tr>

                <tr>
                    <th>Sector Policy and Plan</th>
                    <td>{{ $conceptNote->contribution_sector }}</td>
                </tr>
                <tr>
                    <th>Responsible Officer</th>
                    <td>{{ $responsible_officer }}</td>
                </tr>
                <tr>
                    <th>Administrative Unit</th>
                    <td>{{ $conceptNote->administrative_unit }}</td>
                </tr>
            </tbody>
        </table>
         <br />
        <h2>2. Project Background</h2>
        <p style="text-align:justify;">{{ $project_background }}</p>
        <br />
        <h2>3. Project Justification</h2>
        <p style="text-align:justify;">{{ $project_justification }}</p>
        <br />
        <h2>4. Proposed Outcomes</h2>
        <p style="text-align:justify;">{{ $proposed_outcomes }}</p>
        <br />
        <h2>5. Project Outline</h2>
        <p style="text-align:justify;"><strong>5.1 Overall Approach:</strong> {{ $project_outline_approach }}</p>
        <br />
        <p style="text-align:justify;"><strong>5.2 Outputs:</strong> {{ $project_outline_outputs }}</p>
        <br />
        <p style="text-align:justify;"><strong>5.3 Inputs:</strong> {{ $project_outline_inputs }}</p>
        <br />
        <p style="text-align:justify;"><strong>5.4 Sustainability & Risks:</strong> {{ $project_outline_sustainabilityRisk }}</p>

        <h2>6. Tentative Financing Arrangement</h2>
        <p>Source of Fund(s): {{ $financing_modality  }}</p>
        <p>{{ $tentative_financing_arrangement  }}</p>


        @else
            <p>Loading concept note details...</p>
        @endif

        <!-- More sections can be added similarly -->
    </main>
</body>
</html>
