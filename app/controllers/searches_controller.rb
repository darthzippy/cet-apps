class SearchesController < ApplicationController
  
  require 'prawn'
  require 'fastercsv'
  
  layout 'application_new'
    
  before_filter :login_required
  
  def new
    @search = Search.new
    @latest_search = Search.last
  end
  
  def create
    @search = Search.new(params[:search])
    if @search.save
      redirect_to @search
    else
      render :action => 'new'
    end
  end
  
  def show
    @search = Search.find(params[:id])
    
    respond_to do |format|
      format.html
      format.xml { render :xml => @search }
      format.pdf
      format.csv do
        @outfile = "cet_computers_" + Time.now.strftime("%m-%d-%Y") + ".csv"

        csv_data = FasterCSV.generate do |csv|
          csv << [
          "Control",
          "Serial",
          "Model",
          "Manufacturer",
          "Computer Type",
          "Purchase Date",
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
          @search.computers.each do |computer|
            #unless computer.department.nil?
              csv << [
              computer.control,
              computer.serial,
              computer.model,
              computer.manufacturer,
              computer.computer_type,
              computer.purchase_date,
              computer.warranty_type,
              computer.warranty_end,
              computer.part_number,
              computer.cameron_id,
              computer.status,
              computer.department.try(:name),
              computer.department.try(:maintenance_account),
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
  
  def edit_multiple
    @computers = Computer.find(params[:computer_ids])
  end
  
  def update_multiple
    @computers = Computer.find(params[:computer_ids])
    @computers.each do |computer|
      computer.update_attributes!(params[:computer].reject { |k,v| v.blank? })
    end
    flash[:notice] = "Computers Updated"
    @latest_search = Search.last
    redirect_to search_path(@latest_search)
  end
end
