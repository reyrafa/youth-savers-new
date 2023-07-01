<table>
    <thead>
        <tr>
            <td colspan="10">{{ 'YOUTH SAVERS CLUB REPORT' . ' - ' . now() }}</td>
        </tr>
        <tr>
            <td colspan="10">{{ ($status != 'ALL REPORT') ? $status->status_name : $status}}</td>
        </tr>
        <tr></tr>
        <tr>
            <th>{{ 'CID' }}</th>
            <th>{{ 'FIRST NAME' }}</th>
            <th>{{ 'MIDDLE NAME' }}</th>
            <th>{{ 'LAST NAME' }}</th>
            <th>{{ 'FULL NAME' }}</th>
            <th>{{ 'GENDER' }}</th>
            <th>{{ 'AGE' }}</th>
            <th>{{ 'BIRTH DATE' }}</th>
            <th>{{ 'ADDRESS' }}</th>
            <th>{{ 'PHONE NUMBER' }}</th>
            <th>{{ 'EMAIL' }}</th>
            <th>{{ 'BRANCH' }}</th>
            <th>{{ 'APPLICATION DATE' }}</th>
            <th>{{ 'APPLICATION STATUS' }}</th>
            <th>{{ 'VERIFIED BY' }}</th>
            <th>{{ 'VERIFIED DATE' }}</th>
            <th>{{ 'APPROVED BY' }}</th>
            <th>{{ 'APPROVED DATE' }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->depositor->id }}</td>
                <td>{{ strtoupper($transaction->depositor->fname) }}</td>
                <td>{{ strtoupper($transaction->depositor->mname) }}</td>
                <td>{{ strtoupper($transaction->depositor->lname) }}</td>
                <td>{{ strtoupper($transaction->depositor->lname) . ', ' . strtoupper($transaction->depositor->fname) . ' ' . strtoupper($transaction->depositor->mname) }}
                </td>
                <td>{{ strtoupper($transaction->depositor->gender) }}</td>
           
                @php
                    $birthdate = $transaction->depositor->birth_date;
                    $today = new DateTime();
                    $diff = $today->diff(new DateTime($birthdate));
                    $age = $diff->y;
                @endphp
                <td>{{ $age }}</td>
                <td>{{ $transaction->depositor->birth_date }}</td>
                <td>{{ strtoupper($transaction->depositor->home_address) }}</td>
                <td>{{ strtoupper($transaction->depositor->contact_number) }}</td>
                <td>{{ $transaction->depositor->email_add }}</td>
                <td>{{ strtoupper($transaction->depositor->branch->branch_name) }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ strtoupper($transaction->status->status_name) }}</td>
                <td>{{  strtoupper($transaction->verified->fname) . ' ' . strtoupper($transaction->verified->mname) .' '. strtoupper($transaction->verified->lname) }}
                </td>
                 <td>{{ $transaction->verified_at }}</td>
                 <td>{{ strtoupper($transaction->approved->fname) . ' ' . strtoupper($transaction->approved->mname).' '. strtoupper($transaction->approved->lname)  }}
                </td>
                  <td>{{ $transaction->approved_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
