class DepartmentsController < ApplicationController
  
  layout 'application'
  
  before_filter :login_required
  
  auto_complete_for :department, :name
  protect_from_forgery :except => [:auto_complete_for_department_name]
  
  # GET /departments
  # GET /departments.xml
  def index
    @departments = Department.search(params[:search], params[:page])
    @all_departments = Department.all
    @computers = Computer.in_use
    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @departments }
      format.csv do
        @outfile = "departments_" + Time.now.strftime("%m-%d-%Y") + ".csv"

        csv_data = FasterCSV.generate do |csv|
          csv << [
          "Name",
          "Account Number",
          "Maintenance Total"
          ]
          @all_departments.each do |dept|
            #unless dept.nil?
              csv << [
              dept.name,
              dept.try(:maintenance_account),
              dept.maintenance_fee_total
              ]
            #end
          end
        end

        send_data csv_data,
          :type => 'text/csv; charset=iso-8859-1; header=present',
          :disposition => "attachment; filename=#{@outfile}"

        flash[:notice] = "Export complete!"
      end
    end
  end

  # GET /departments/1
  # GET /departments/1.xml
  def show
    @department = Department.find(params[:id], :include => {:computers => :hardware_assignments})
    @computers = @department.computers.ordered

    case params[:filter]
    when 'pcs' then @computers = @department.computers.ordered.pcs
    when 'macs' then @computers = @department.computers.ordered.macs
    when 'printers' then @computers = @department.computers.ordered.printers
    else @computers = @department.computers.ordered
    end

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @department }
      format.csv do
        @outfile = "dept_computers_" + Time.now.strftime("%m-%d-%Y") + ".csv"

        csv_data = FasterCSV.generate do |csv|
          csv << [
          "Control",
          "Serial",
          "Model",
          "Manufacturer",
          "Computer Type",
          "Purchase Date",
          "Purchase Price",
          "Account Number",
          "Warranty Type",
          "Warranty End Date",
          "Part Number",
          "Cameron ID",
          "Status",
          "Department",
          "Maintenance Account",
          "User",
          "Email",
          "Maintenance Fee"
          ]
          @department.computers.each do |computer|
            #unless computer.department.nil?
              csv << [
              computer.control,
              computer.serial,
              computer.model,
              computer.manufacturer,
              computer.computer_type,
              computer.purchase_date,
              computer.purchase_price,
              computer.purchase_acct, 
              computer.warranty_type,
              computer.warranty_end,
              computer.part_number,
              computer.cameron_id,
              computer.status,
              computer.departments.first.try(:name),
              computer.departments.first.try(:maintenance_account),
              computer.user.try(:fullname),
              computer.user.try(:email),
              computer.try(:maintenance_fee)
              ]
            #end
          end
        end

        send_data csv_data,
          :type => 'text/csv; charset=iso-8859-1; header=present',
          :disposition => "attachment; filename=#{@outfile}"

        flash[:notice] = "Export complete!"
      end  
    end
  end

  # GET /departments/new
  # GET /departments/new.xml
  def new
    @department = Department.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @department }
    end
  end

  # GET /departments/1/edit
  def edit
    @department = Department.find(params[:id])
  end

  # POST /departments
  # POST /departments.xml
  def create
    @department = Department.new(params[:department])

    respond_to do |format|
      if @department.save
        flash[:notice] = 'Department was successfully created.'
        format.html { redirect_to(@department) }
        format.xml  { render :xml => @department, :status => :created, :location => @department }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @department.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /departments/1
  # PUT /departments/1.xml
  def update
    @department = Department.find(params[:id])

    respond_to do |format|
      if @department.update_attributes(params[:department])
        flash[:notice] = 'Department was successfully updated.'
        format.html { redirect_to(@department) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @department.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /departments/1
  # DELETE /departments/1.xml
  def destroy
    @department = Department.find(params[:id])
    @department.destroy

    respond_to do |format|
      format.html { redirect_to(departments_url) }
      format.xml  { head :ok }
    end
  end
end
