<div class="card card-position card-{{ $position->id }}">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 column">
                <!-- Name Position -->
                <div class="card-position__title d-flex">
                    <h5>{{ $position->name }}</h5>
                    <div class="card-position__image" style="background-image: url('{{ asset($position->user->logo) }}')">
                    </div>
                </div>

                <!-- Description Position -->
                <div class="card-position__description">
                    <p>{{ $position->description }}</p>
                </div>

                <!--English Position -->
                <div class="card-position__english pt-2">
                    <h6>English</h6>
                    <p>{{ $position->english }}</p>
                </div>

                <!-- Matches Position -->
                <div class="card-position__matches d-flex pt-2">
                    <h6>Has suggested:</h6>
                    <p class="ml-2"><strong>{{ count($position->matches) }}</strong> applicants</p>
                </div>
            </div>
        </div>
    </div>
</div>
