<x-master title="{{__('Create Motive ')}}">
<x-navbar/>
   <div class="container">
        <h2>Create New Motive</h2>
        <form action="{{ route('motive.store') }}" method="POST">
            @csrf

         <input type="hidden" name="ObjectiveID" value="{{ $objectiveId }}">

           <div class="mb-3">
    <label for="motive_type" class="form-label">Motive Type</label>
    <select class="form-select @error('MotiveType') is-invalid @enderror" id="motive_type" name="MotiveType" required>
        <option value="" disabled selected>Select a Motive Type</option>
        <option value="reason why to do objective" {{ old('MotiveType') === 'reason why to do objective' ? 'selected' : '' }}>Reason Why to Do Objective</option>
        <option value="reward" {{ old('MotiveType') === 'reward' ? 'selected' : '' }}>Reward</option>
        <option value="penalty" {{ old('MotiveType') === 'penalty' ? 'selected' : '' }}>Penalty</option>
    </select>
    @error('MotiveType')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


            <div class="mb-3">
                <label for="MotiveTitle" class="form-label">Motive Title</label>
                <input type="text" class="form-control @error('MotiveTitle') is-invalid @enderror" id="MotiveTitle" name="MotiveTitle" value="{{ old('MotiveTitle') }}" required>
                @error('MotiveTitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="MotiveDescription" class="form-label">Motive Description</label>
                <textarea class="form-control @error('MotiveDescription') is-invalid @enderror" id="MotiveDescription" name="MotiveDescription" rows="4" required>{{ old('MotiveDescription') }}</textarea>
                @error('MotiveDescription')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Motive</button>
        </form>
    </div>
<x-footer/>
</x-master>