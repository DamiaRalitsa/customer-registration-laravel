<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        
        .section-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
            color: #555;
        }
        
        .form-control {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 12px;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .family-member {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 10px;
        }
        
        .family-member-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .family-member-title {
            font-weight: 500;
            color: #333;
        }
        
        .btn-remove {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .btn-remove:hover {
            background-color: #c82333;
        }
        
        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .btn-add:hover {
            background-color: #218838;
        }
        
        .btn-submit {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        
        .btn-submit:hover {
            background-color: #0056b3;
        }
        
        .alert {
            margin-bottom: 20px;
        }
        
        .row {
            margin-left: -5px;
            margin-right: -5px;
        }
        
        .col-md-6 {
            padding-left: 5px;
            padding-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Customer Registration</h2>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('customer.store') }}" method="POST" id="customerForm">
            @csrf
            
            <!-- User Section -->
            <div class="section-title">USER</div>
            
            <div class="form-group">
                <label for="cst_name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="cst_name" name="cst_name" 
                       placeholder="Masukan nama anda" value="{{ old('cst_name') }}" required>
            </div>
            
            <div class="form-group">
                <label for="cst_dob" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="cst_dob" name="cst_dob" 
                       value="{{ old('cst_dob') }}" required>
            </div>
            
            <div class="form-group">
                <label for="nationality_id" class="form-label">Kewarganegaraan</label>
                <select class="form-control" id="nationality_id" name="nationality_id" required>
                    <option value="">Pilih kewarganegaraan</option>
                    @foreach($nationalities as $nationality)
                        <option value="{{ $nationality->nationality_id }}" 
                                {{ old('nationality_id') == $nationality->nationality_id ? 'selected' : '' }}>
                            {{ $nationality->nationality_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="cst_phonenum" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="cst_phonenum" name="cst_phonenum" 
                       placeholder="Masukan nomor telepon" value="{{ old('cst_phonenum') }}" required>
            </div>
            
            <div class="form-group">
                <label for="cst_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="cst_email" name="cst_email" 
                       placeholder="Masukan email" value="{{ old('cst_email') }}" required>
            </div>
            
            <!-- Family Section -->
            <div class="section-title mt-4">Keluarga</div>
            <button type="button" class="btn-add" onclick="addFamilyMember()">+ Tambah Keluarga</button>
            
            <div id="familyMembersContainer">
                <!-- Family members will be added here dynamically -->
            </div>
            
            <button type="submit" class="btn-submit mt-4">Submit</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let familyMemberCount = 0;
        
        function addFamilyMember() {
            familyMemberCount++;
            const container = document.getElementById('familyMembersContainer');
            
            const familyMemberHtml = `
                <div class="family-member" id="familyMember${familyMemberCount}">
                    <div class="family-member-header">
                        <span class="family-member-title">Anggota Keluarga ${familyMemberCount}</span>
                        <button type="button" class="btn-remove" onclick="removeFamilyMember(${familyMemberCount})">Hapus</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="family_members[${familyMemberCount}][ft_name]" 
                                       placeholder="Masukan Nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="family_members[${familyMemberCount}][ft_dob]" 
                                       placeholder="Pilih tanggal" required>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', familyMemberHtml);
        }
        
        function removeFamilyMember(id) {
            const element = document.getElementById(`familyMember${id}`);
            if (element) {
                element.remove();
            }
        }
        
        // Add initial family member on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Add one family member by default
            // addFamilyMember();
        });
    </script>
</body>
</html>
