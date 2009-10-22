class ShiftsController < ApplicationController
  
  layout 'application'
  
  before_filter :login_required
  
  # GET /shifts
  # GET /shifts.xml
  def index
    @shifts = Shift.my_shifts(current_cet_user.id)

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @shifts }
      format.js
    end
  end

  # GET /shifts/1
  # GET /shifts/1.xml
  def show
    @shift = Shift.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @shift }
    end
  end

  # GET /shifts/new
  # GET /shifts/new.xml
  def new
    @shift = Shift.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @shift }
    end
  end

  # GET /shifts/1/edit
  def edit
    @shift = Shift.find(params[:id])
  end

  # POST /shifts
  # POST /shifts.xml
  def create
    @shift = Shift.new(params[:shift])
    @shift.update_attributes( :cet_user_id => current_cet_user.id, :start_time => Time.now )
    
    #@license = @user.licenses.build(params[:license])
    #@license.updated_by=current_cet_user.display_name

    respond_to do |format|
      if @shift.save
        format.html { redirect_to(@shift) }
        format.xml  { render :xml => @shift, :status => :created, :location => @shift }
        format.js
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @shift.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /shifts/1
  # PUT /shifts/1.xml
  def update
    @shift = Shift.find(params[:id])
    @shift.update_attributes( :cet_user_id => current_cet_user.id )

    respond_to do |format|
      if @shift.update_attributes(params[:shift])
        format.html { redirect_to(@shift) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @shift.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /shifts/1
  # DELETE /shifts/1.xml
  def destroy
    @shift = Shift.find(params[:id])
    @shift.destroy

    respond_to do |format|
      format.html { redirect_to(shifts_url) }
      format.xml  { head :ok }
    end
  end
  
  def end_shift
    @shift = Shift.find(params[:id])
    @shift.update_attributes( :end_time => Time.now )

    respond_to do |format|
      if @shift.update_attributes(params[:shift])
        format.html { redirect_to shifts_path }
        format.xml  { head :ok }
        format.js
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @shift.errors, :status => :unprocessable_entity }
      end
    end
  end
end
