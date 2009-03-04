class SearchesController < ApplicationController
  
  require 'prawn'
  
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
        csv_string = FasterCSV.generate do |csv|
        # header row
          csv << ["control", "model", "purchase date"]

        # data rows
          @search.computers.each do |computer|
            csv << [computer.control, computer.model, computer.purchase_date]
          end
        end

        # send it to the browser
        send_data csv_string,
                :type => 'text/csv; charset=iso-8859-1; header=present',
                :disposition => "attachment; filename=cet_eq_custom_search.csv"
      end
    end
  end
end
