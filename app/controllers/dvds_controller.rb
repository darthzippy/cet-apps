class DvdsController < ApplicationController
  
  layout 'application'
  
  before_filter :login_required
  
  # GET /dvds
  # GET /dvds.xml
  def index
    @dvds = Dvd.to_be_delivered.search(params[:search], params[:page])
    case params[:filter]
      when 'to_be_delivered' then @dvds = Dvd.to_be_delivered.search(params[:search], params[:page])
      when 'all' then @dvds = Dvd.search(params[:search], params[:page])
      else @dvds = Dvd.search(params[:search], params[:page])
    end

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @dvds }
      format.csv do
        @dvds = Dvd.find(:all)
        @outfile = "dvd_sales_" + Time.now.strftime("%m-%d-%Y") + ".csv"

        csv_data = FasterCSV.generate do |csv|
          csv << [
          "First name",
          "Last name",
          "Address Line 1",
          "Address line 2",
          "City",
          "State",
          "Zip",
          "Email Address",
          "Phone Number",
          "Quantity",
          "Pickup Method",
          "Paid - Y/N",
          "Paid Date",
          "Cash or Check",
          "Delivered - Y/N"
          ]
          @dvds.each do |dvd|
              csv << [
              dvd.firstname,
              dvd.lastname,
              dvd.address1,
              dvd.address2,
              dvd.city,
              dvd.state,
              dvd.zip,
              dvd.email,
              dvd.phone,
              dvd.quantity,
              dvd.pickup,
              dvd.paid,
              dvd.paid_date,
              dvd.paid_with,
              dvd.delivered
              ]
          end
        end

        send_data csv_data,
          :type => 'text/csv; charset=iso-8859-1; header=present',
          :disposition => "attachment; filename=#{@outfile}"

        flash[:notice] = "Export complete!"
      end
    end
  end

  # GET /dvds/1
  # GET /dvds/1.xml
  def show
    @dvd = Dvd.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @dvds }
    end
  end

  # GET /dvds/new
  # GET /dvds/new.xml
  def new
    @dvd = Dvd.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @dvd }
    end
  end

  # GET /dvds/1/edit
  def edit
    @dvd = Dvd.find(params[:id])
  end

  # POST /dvds
  # POST /dvds.xml
  def create
    @dvd = Dvd.new(params[:dvd])
    @dvd.update_attributes( :updated_by => current_cet_user.display_name )

    respond_to do |format|
      if @dvd.save
        flash[:notice] = 'Dvd was successfully created.'
        format.html { redirect_to(@dvd) }
        format.xml  { render :xml => @dvd, :status => :created, :location => @dvd }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @dvd.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /dvds/1
  # PUT /dvds/1.xml
  def update
    @dvd = Dvd.find(params[:id])
    @dvd.update_attributes( :updated_by => current_cet_user.display_name )

    respond_to do |format|
      if @dvd.update_attributes(params[:dvd])
        flash[:notice] = 'Dvd was successfully updated.'
        format.html { redirect_to(@dvd) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @dvd.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /dvds/1
  # DELETE /dvds/1.xml
  def destroy
    @dvd = Dvd.find(params[:id])
    @dvd.destroy

    respond_to do |format|
      format.html { redirect_to(dvds_url) }
      format.xml  { head :ok }
    end
  end
end
