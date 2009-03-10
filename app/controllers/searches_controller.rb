class SearchesController < ApplicationController
  
  require 'prawn'
  require 'fastercsv'
  
  layout 'application'
    
  #before_filter :login_required
  
  def new
    @search = Search.new
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
      format.pdf { render :layout => false }
      format.csv do
        @outfile = "cet_computers_" + Time.now.strftime("%m-%d-%Y") + ".csv"

        csv_data = FasterCSV.generate do |csv|
          csv << [
          "Name",
          "E-mail",
          "Department",
          "Control",
          "Model"

          ]
          @search.computers.each do |computer|
            unless computer.department.nil? or computer.user.nil?
              csv << [
              computer.user.fullname,
              computer.user.email,
              computer.department.name,
              computer.control,
              computer.model
              ]
            end
          end
        end

        send_data csv_data,
          :type => 'text/csv; charset=iso-8859-1; header=present',
          :disposition => "attachment; filename=#{@outfile}"

        flash[:notice] = "Export complete!"
      end
    end
  end
end
