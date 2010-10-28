class ComputersController < ApplicationController
  
  layout 'application'
  
  before_filter :login_required
  
  # GET /computers
  # GET /computers.xml
  def index
    @computers = Computer.search(params[:search], params[:page])
    case params[:filter]
      when 'pcs' then @computers = Computer.pcs.search(params[:search], params[:page])
      when 'macs' then @computers = Computer.macs.search(params[:search], params[:page])
      when 'printers' then @computers = Computer.printers.search(params[:search], params[:page])
      else @computers = Computer.search(params[:search], params[:page])
    end
    @computers_in_use = Computer.in_use
    
    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @computers }
    end
  end

  # GET /computers/1
  # GET /computers/1.xml
  def show
    @computer = Computer.find(params[:id])
    @comments = @computer.comments
    
    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @computer }
    end
  end

  # GET /computers/new
  # GET /computers/new.xml
  def new
    @computer = Computer.new
    @computer.hardware_assignments.build

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @computer }
    end
  end

  # GET /computers/1/edit
  def edit
    @computer = Computer.find(params[:id])
  end

  # POST /computers
  # POST /computers.xml
  def create
    @computer = Computer.new(params[:computer])

    respond_to do |format|
      if @computer.save
        flash[:notice] = 'Computer was successfully created.'
        format.html { redirect_to(@computer) }
        format.xml  { render :xml => @computer, :status => :created, :location => @computer }
        format.js
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @computer.errors, :status => :unprocessable_entity }
        format.js do
          render :update do |page|
            page.redirect_to @computer
          end
        end
      end
    end
  end

  # PUT /computers/1
  # PUT /computers/1.xml
  def update
    @computer = Computer.find(params[:id])

    respond_to do |format|
      if @computer.update_attributes(params[:computer])
        flash[:notice] = 'Computer was successfully updated.'
        format.html { redirect_to(@computer) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @computer.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /computers/1
  # DELETE /computers/1.xml
  def destroy
    @computer = Computer.find(params[:id])
    @computer.destroy

    respond_to do |format|
      format.html { redirect_to(computers_url) }
      format.xml  { head :ok }
    end
  end
  
  def new_quick
    @computer = Computer.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @computer }
    end
  end
  
  def create_quick
    @computers = Computer.new(params[:new_computers])
    @computers.each do |c|
      c.save
    end
    respond_to do |format|
      flash[:notice] = 'Computers were successfully created.'
      format.html { redirect_to computers_path }
      format.js
    end
  end
  
end
